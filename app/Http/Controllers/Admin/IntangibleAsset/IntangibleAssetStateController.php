<?php

namespace App\Http\Controllers\Admin\IntangibleAsset;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\IntangibleAssets\States\StoreRequest;

use App\Http\Requests\Admin\IntangibleAssets\States\UpdateRequest;

use App\Services\Admin\IntangibleAssetStateService;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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
            $params = $this->intangibleAssetStateService->transformParams($request->all());
            $query = $this->intangibleAssetStateRepository->search($params);
            $total = $query->count();
            $items = $this->intangibleAssetStateService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.intangible_assets.states.index', compact('links'))
                ->nest('filters', 'admin.pages.intangible_assets.states.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intangible_assets.states.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intangible_assets.status.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $this->intangibleAssetStateService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intangible_assets.status.create')->with('alert', $response);
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
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $this->intangibleAssetStateService->update($request->all(), $id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intangible_assets.status.edit', $id)->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->intangibleAssetStateRepository->getById($id);
            DB::beginTransaction();
            $this->intangibleAssetStateService->delete($id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntangibleAssets/IntangibleAssetState:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intangible_assets.status.index')->with('alert', $response);
    }
}
