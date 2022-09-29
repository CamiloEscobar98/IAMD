<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Client\Creators\External\StoreRequest;
use App\Http\Requests\Client\Creators\External\UpdateRequest;

use App\Services\Client\CreatorExternalService;

use App\Repositories\Client\CreatorExternalRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\CreatorDocumentRepository;

class CreatorExternalController extends Controller
{
    /** @var CreatorExternalService */
    protected $creatorExternalService;

    /** @var CreatorExternalRepository */
    protected $creatorExternalRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var CreatorDocumentRepository */
    protected $creatorDocumentRepository;

    public function __construct(
        CreatorExternalService $creatorExternalService,
        CreatorExternalRepository $creatorExternalRepository,
        CreatorRepository $creatorRepository,
        CreatorDocumentRepository $creatorDocumentRepository,
    ) {
        $this->middleware('auth');

        $this->creatorExternalService = $creatorExternalService;

        $this->creatorExternalRepository = $creatorExternalRepository;
        $this->creatorRepository = $creatorRepository;
        $this->creatorDocumentRepository = $creatorDocumentRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @var Request $request
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request) #: \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            $params = $this->creatorExternalService->transformParams($request->all());

            // return $params;

            $query = $this->creatorExternalRepository->search($params, [
                'creator', 'external_organization', 'assignment_contract', 'creator.document',
                'creator.document.document_type', 'creator.document.expedition_place'
            ], []);

            $total = $query->count();

            $items = $this->creatorExternalService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.creators.external.index')
                ->nest('filters', 'client.pages.creators.external.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.creators.external.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            return view('client.pages.creators.external.create');
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            DB::beginTransaction();
            $creatorData = $request->only(['name', 'email', 'phone']);

            $creator = $this->creatorRepository->create($creatorData);

            $creatorDocumentData = $request->only(['document', 'document_type_id', 'expedition_place_id']);
            $creatorDocumentData['creator_id'] = $creator->id;

            $creatorDocument = $this->creatorDocumentRepository->create($creatorDocumentData);

            $creatorExternalData = $request->only(['external_organization_id', 'assignment_contract_id']);
            $creatorExternalData['creator_id'] = $creator->id;

            $creatorInternal = $this->creatorExternalRepository->create($creatorExternalData);
            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.creators.external.messages.save_success', ['creator_external' => $creator->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $external
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id, $external, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorExternalRepository->getByIdWithRelations($external, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place.state.country',
                'external_organization', 'assignment_contract'
            ], 'creator_id');

            return view('client.pages.creators.external.show', compact('item'));
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $external
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, $external, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorExternalRepository->getByIdWithRelations($external, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
                'external_organization', 'assignment_contract'
            ], 'creator_id');

            return view('client.pages.creators.external.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param int $internal
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(UpdateRequest $request, $id, $internal): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            DB::beginTransaction();
            $creatorData = $request->only(['name', 'email', 'phone']);

            $creatorExternal = $this->creatorExternalRepository->getByIdWithRelations($internal, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
                'external_organization', 'assignment_contract'
            ], 'creator_id');

            $creator = $creatorExternal->creator;

            $this->creatorRepository->update($creator, $creatorData);

            $creatorDocumentData = $request->only(['document', 'document_type_id', 'expedition_place_id']);
            $creatorDocumentData['creator_id'] = $creator->id;

            $creatorDocument = $creatorExternal->creator->document;

            $this->creatorDocumentRepository->update($creatorDocument, $creatorDocumentData);

            $creatorExternalData = $request->only(['external_organization_id', 'assignment_contract_id']);
            $creatorExternalData['creator_id'] = $creator->id;

            $creatorExternal = $this->creatorExternalRepository->update($creatorExternal, $creatorExternalData);
            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.creators.external.messages.update_success', ['creator_external' => $creator->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $internal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $external)
    {
        try {
            $item = $this->creatorExternalRepository->getByIdWithRelations($external, ['creator'], 'creator_id');

            DB::beginTransaction();

            $this->creatorExternalRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.creators.external.messages.delete_success', ['creator_external' => $item->creator->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.creators.external.messages.delete_error')]);
        }
    }
}
