<?php

namespace App\Http\Controllers\Admin\IntangibleAsset;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\IntangibleAssets\States\StoreRequest;

use App\Http\Requests\Admin\IntangibleAssets\States\UpdateRequest;

use App\Services\Admin\IntangibleAssetStateService;

use App\Repositories\Admin\IntangibleAssetStateRepository;

class IntangibleAssetStateController extends Controller
{
    /** @var IntangibleAssetStateService */
    protected $intangibleAssetStateService;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    public function __construct(
        IntangibleAssetStateService $intangibleAssetStateService,
        IntangibleAssetStateRepository $intangibleAssetStateRepository
    ) {
        $this->middleware('auth:admin');

        $this->intangibleAssetStateService = $intangibleAssetStateService;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            [$params, $total, $items, $links] = $this->intangibleAssetStateService->searchWithPagination($request->all(), $request->get('page'));
            return view('admin.pages.intangible_assets.states.index', compact('links'))
                ->nest('filters', 'admin.pages.intangible_assets.states.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intangible_assets.states.components.table', compact('items'));
        } catch (\Exception $th) {
            dd($th->getMessage());
            return redirect()->route('admin.intangible_assets.status.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $item = $this->intangibleAssetStateRepository->newInstance();
            return view('admin.pages.intangible_assets.states.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return redirect()->route('admin.intangible_assets.status.create')->with('alert', $this->intangibleAssetStateService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->intangibleAssetStateRepository->getById($id);
            return view('admin.pages.intangible_assets.states.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $item = $this->intangibleAssetStateRepository->getById($id);
            return view('admin.pages.intangible_assets.states.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
       return redirect()->route('admin.intangible_assets.status.edit', $id)->with('alert', $this->intangibleAssetStateService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('admin.intangible_assets.status.index')->with('alert', $this->intangibleAssetStateService->delete($id));
    }
}
