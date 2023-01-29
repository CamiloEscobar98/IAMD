<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Client\Creators\Internal\StoreRequest;
use App\Http\Requests\Client\Creators\Internal\UpdateRequest;

use App\Services\Client\CreatorInternalService;

use App\Repositories\Client\CreatorInternalRepository;

class CreatorInternalController extends Controller
{
    /** @var CreatorInternalService */
    protected $creatorInternalService;

    /** @var CreatorInternalRepository */
    protected $creatorInternalRepository;

    public function __construct(
        CreatorInternalService $creatorInternalService,
        CreatorInternalRepository $creatorInternalRepository,
    ) {
        $this->middleware('auth');

        $this->middleware('permission:creators.internal.index')->only('index');
        $this->middleware('permission:creators.internal.show')->only('show');
        $this->middleware('permission:creators.internal.store')->only(['create', 'store']);
        $this->middleware('permission:creators.internal.update')->only(['edit', 'update']);
        $this->middleware('permission:creators.internal.destroy')->only('destroy');

        $this->creatorInternalService = $creatorInternalService;

        $this->creatorInternalRepository = $creatorInternalRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param string $client
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, $client): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->creatorInternalService->searchWithPagination($request->all(), $request->get('page'), [
                'creator', 'linkage_type', 'assignment_contract', 'creator.document',
                'creator.document.document_type', 'creator.document.expedition_place'
            ]);
            return view('client.pages.creators.internal.index', compact('links'))
                ->nest('filters', 'client.pages.creators.internal.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.creators.internal.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @param string $client
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create($client): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorInternalRepository->newInstance();
            return view('client.pages.creators.internal.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.creators.internal.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        return redirect()->route('client.creators.internal.create', $client)->with('alert', $this->creatorInternalService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $client
     * @param int $internal
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($client, $internal, Request $request) #: \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorInternalRepository->getByIdWithRelations($internal, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place.state.country',
                'linkage_type', 'assignment_contract'
            ], 'creator_id');
            return view('client.pages.creators.internal.show', compact('item'));
        } catch (\Exception $th) {

            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @param int $internal
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($client, $internal, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->creatorInternalRepository->getByIdWithRelations($internal, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
                'linkage_type', 'assignment_contract'
            ], 'creator_id');

            return view('client.pages.creators.internal.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @param int $internal
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(UpdateRequest $request, $client, $internal): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        return redirect()->route('client.creators.internal.edit', ['internal' => $internal, 'client' => $client])
            ->with('alert', $this->creatorInternalService->update($request->all(), $internal));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @param int $internal
     * @return \Illuminate\Http\Response
     */
    public function destroy($client, $internal)
    {
        return redirect()->route('client.creators.internal.index', $client)->with('alert', $this->creatorInternalService->delete($internal));
    }
}
