<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;



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

        $this->creatorInternalRepository = $creatorInternalRepository;
        $this->creatorInternalService = $creatorInternalService;
    }

    /**
     * Display a listing of the resource.
     * 
     * @var Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) #: \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            $params = $this->creatorInternalService->transformParams($request->all());

            $query = $this->creatorInternalRepository->search($params, [
                'creator', 'linkage_type', 'assignment_contract', 'creator.document',
                'creator.document.document_type', 'creator.document.expedition_place'
            ], []);

            $total = $query->count();

            $items = $this->creatorInternalService->customPagination($query, $params, $request->get('page'), $total);
            // return $items;

            $links = $items->links('pagination.customized');

            return view('client.pages.creators.internal.index')
                ->nest('filters', 'client.pages.creators.internal.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.creators.internal.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $creator_internal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $creator_internal)
    {
        try {
            $item = $this->creatorInternalRepository->getByIdWithRelations($creator_internal, ['creator'], 'creator_id');

            DB::beginTransaction();

            $this->creatorInternalRepository->delete($item);

            DB::commit();

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.creators.internal.messages.delete_success', ['creator_internal' => $item->creator->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return $th->getMessage();
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.creators.internal.messages.delete_error')]);
        }
    }
}
