<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Client\Creators\External\StoreRequest;
use App\Http\Requests\Client\Creators\External\UpdateRequest;

use App\Services\Client\CreatorExternalService;

use App\Repositories\Client\CreatorExternalRepository;

class CreatorExternalController extends Controller
{
    /** @var CreatorExternalService */
    protected $creatorExternalService;

    /** @var CreatorExternalRepository */
    protected $creatorExternalRepository;

    public function __construct(
        CreatorExternalService $creatorExternalService,
        CreatorExternalRepository $creatorExternalRepository,
    ) {
        $this->middleware('auth');

        $this->middleware('permission:creators.external.index')->only('index');
        $this->middleware('permission:creators.external.show')->only('show');
        $this->middleware('permission:creators.external.store')->only(['create', 'store']);
        $this->middleware('permission:creators.external.update')->only(['edit', 'update']);
        $this->middleware('permission:creators.external.destroy')->only('destroy');

        $this->creatorExternalService = $creatorExternalService;
        $this->creatorExternalRepository = $creatorExternalRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param string $client
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, $client) #: \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->creatorExternalService->searchWithPagination($request->all(), $request->get('page'), [
                'creator', 'external_organization', 'assignment_contract', 'creator.document',
                'creator.document.document_type', 'creator.document.expedition_place'
            ]);
            return view('client.pages.creators.external.index', compact('links'))
                ->nest('filters', 'client.pages.creators.external.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.creators.external.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $client
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create($client): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorExternalRepository->newInstance();
            return view('client.pages.creators.external.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.creators.external.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $client
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(StoreRequest $request, $client): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        return redirect()->route('client.creators.external.create', $client)->with('alert', $this->creatorExternalService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $client
     * @param string $external
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($client, $external, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorExternalRepository->getByIdWithRelations($external, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place.state.country',
                'external_organization', 'assignment_contract'
            ], 'creator_id');
            return view('client.pages.creators.external.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.creators.external.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @param string $external
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($client, $external, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorExternalRepository->getByIdWithRelations($external, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
                'external_organization', 'assignment_contract'
            ], 'creator_id');
            return view('client.pages.creators.external.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.creators.external.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @param string $external
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(UpdateRequest $request, $client, $external): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        return redirect()->route('client.creators.external.edit', ['external' => $external, 'client' => $client])
            ->with('alert', $this->creatorExternalService->update($request->all(), $external));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @param string $external
     * @return \Illuminate\Http\Response
     */
    public function destroy($client, $external)
    {
        return redirect()->route('client.creators.external.index', $client)->with('alert', $this->creatorExternalService->delete($external));
    }
}
