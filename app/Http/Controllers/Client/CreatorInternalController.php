<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Client\Creators\Internal\StoreRequest;
use App\Http\Requests\Client\Creators\Internal\UpdateRequest;

use App\Services\Client\CreatorInternalService;

use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\CreatorInternalRepository;
use App\Repositories\Client\CreatorDocumentRepository;

class CreatorInternalController extends Controller
{
    /** @var CreatorInternalService */
    protected $creatorInternalService;

    /** @var CreatorInternalRepository */
    protected $creatorInternalRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var CreatorDocumentRepository */
    protected $creatorDocumentRepository;

    public function __construct(
        CreatorInternalService $creatorInternalService,
        CreatorInternalRepository $creatorInternalRepository,
        CreatorRepository $creatorRepository,
        CreatorDocumentRepository $creatorDocumentRepository,
    ) {
        $this->middleware('auth');

        $this->middleware('permission:creators.internal.index')->only('index');
        $this->middleware('permission:creators.internal.show')->only('show');
        $this->middleware('permission:creators.internal.store')->only(['create', 'store']);
        $this->middleware('permission:creators.internal.update')->only(['edit', 'update']);
        $this->middleware('permission:creators.internal.destroy')->only('destroy');

        $this->creatorInternalService = $creatorInternalService;

        $this->creatorInternalRepository = $creatorInternalRepository;
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
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            $params = $this->creatorInternalService->transformParams($request->all());

            $query = $this->creatorInternalRepository->search($params, [
                'creator', 'linkage_type', 'assignment_contract', 'creator.document',
                'creator.document.document_type', 'creator.document.expedition_place'
            ], []);

            $total = $query->count();

            $items = $this->creatorInternalService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.creators.internal.index')
                ->nest('filters', 'client.pages.creators.internal.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.creators.internal.components.table', compact('items', 'links'));
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
            $item = $this->creatorInternalRepository->newInstance();
            return view('client.pages.creators.internal.create', compact('item'));
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

            $creatorInternalData = $request->only(['linkage_type_id', 'assignment_contract_id']);
            $creatorInternalData['creator_id'] = $creator->id;

            $creatorInternal = $this->creatorInternalRepository->create($creatorInternalData);
            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.creators.internal.messages.save_success', ['creator_internal' => $creator->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $internal
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id, $internal, Request $request) #: \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorInternalRepository->getByIdWithRelations($internal, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place.state.country',
                'linkage_type', 'assignment_contract'
            ], 'creator_id');

            return view('client.pages.creators.internal.show', compact('item'));
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $internal
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, $internal, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorInternalRepository->getByIdWithRelations($internal, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
                'linkage_type', 'assignment_contract'
            ], 'creator_id');

            return view('client.pages.creators.internal.edit', compact('item'));
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

            $creatorInternal = $this->creatorInternalRepository->getByIdWithRelations($internal, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
                'linkage_type', 'assignment_contract'
            ], 'creator_id');

            $creator = $creatorInternal->creator;

            $this->creatorRepository->update($creator, $creatorData);

            $creatorDocumentData = $request->only(['document', 'document_type_id', 'expedition_place_id']);
            $creatorDocumentData['creator_id'] = $creator->id;

            $creatorDocument = $creatorInternal->creator->document;

            $this->creatorDocumentRepository->update($creatorDocument, $creatorDocumentData);

            $creatorInternalData = $request->only(['linkage_type_id', 'assignment_contract_id']);
            $creatorInternalData['creator_id'] = $creator->id;

            $creatorInternal = $this->creatorInternalRepository->update($creatorInternal, $creatorInternalData);
            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.creators.internal.messages.update_success', ['creator_internal' => $creator->name])]);
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
    public function destroy($id, $internal)
    {
        try {
            $item = $this->creatorInternalRepository->getByIdWithRelations($internal, ['creator'], 'creator_id');

            DB::beginTransaction();

            $this->creatorInternalRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.creators.internal.messages.delete_success', ['creator_internal' => $item->creator->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.creators.internal.messages.delete_error')]);
        }
    }
}
