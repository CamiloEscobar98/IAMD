<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Http\Requests\Client\IntangibleAssets\StoreRequest;
use App\Http\Requests\Client\IntangibleAssets\UpdateRequest;

use App\Services\Client\IntangibleAssetService;

use App\Repositories\Client\IntangibleAssetRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class IntangibleAssetController extends Controller
{
    /** @var IntangibleAssetService */
    protected $intangibleAssetService;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    public function __construct(
        IntangibleAssetService $intangibleAssetService,
        IntangibleAssetRepository $intangibleAssetRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:intangible_assets.index')->only('index');
        $this->middleware('permission:intangible_assets.show')->only('show');
        $this->middleware('permission:intangible_assets.store')->only(['create', 'store']);
        $this->middleware('permission:intangible_assets.update')->only(['edit', 'update']);
        $this->middleware('permission:intangible_assets.destroy')->only('destroy');

        $this->intangibleAssetService = $intangibleAssetService;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param string $client
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {
        try {
            $params = $this->intangibleAssetService->transformParams($request->all());
            $query = $this->intangibleAssetRepository->search($params, ['intangible_asset_state', 'project.research_units']);
            $total = $query->count();
            $items = $this->intangibleAssetService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.intangible_assets.index', compact('links'))
                ->nest('filters', 'client.pages.intangible_assets.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.intangible_assets.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $client
     * @return View|RedirectResponse
     */
    public function create($client): View|RedirectResponse
    {
        try {
            $item = $this->intangibleAssetRepository->newInstance();
            return view('client.pages.intangible_assets.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->intangibleAssetService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/IntangibleAssetController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.intangible_assets.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $client
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse|View
     */
    public function show($client, $intangibleAsset) #: RedirectResponse|View
    {
        try {
            $item = $this->intangibleAssetRepository->getByIdWithRelations($intangibleAsset, [
                'intangible_asset_phases', 'dpis.dpi', 'intangible_asset_published', 'intangible_asset_localization',
                'intangible_asset_confidenciality_contract', 'creators', 'intangible_asset_session_right_contract', 'user_messages',
                'secret_protection_measures:id,name', 'priority_tools', 'research_units:id,name'
            ]);
            return view('client.pages.intangible_assets.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @param int $intangible_asset
     * 
     * @return RedirectResponse|View
     */
    public function edit($client, $intangible_asset, Request $request) #: RedirectResponse|View
    {
        try {
            $item = $this->intangibleAssetRepository->getByIdWithRelations($intangible_asset, ['research_units:id,name']);
            return view('client.pages.intangible_assets.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest  $request
     * @param string  $client
     * @param int $intangible_asset
     * 
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $intangible_asset): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->intangibleAssetService->update($request->all(), $intangible_asset);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/IntangibleAssetController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.intangible_assets.edit', compact('client', 'intangible_asset'))->with('alert', $response);
    }

    /**
     * Generate Code
     * 
     * @param int $client
     * @param int $intangible_asset
     * 
     * @return RedirectResponse
     */
    public function updateCode($client, $intangible_asset) #: RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->intangibleAssetService->updateCode($intangible_asset);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/IntangibleAssetController:UpdateCode/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:UpdateCode/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:UpdateCode/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:UpdateCode/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', $this->intangibleAssetService->updateCode($intangible_asset));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @param int $intangible_asset
     * @return View|RedirectResponse
     */
    public function destroy($client, $intangible_asset)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->intangibleAssetRepository->getById($intangible_asset);
            DB::beginTransaction();
            $this->intangibleAssetService->delete($intangible_asset);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/IntangibleAssetController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.intangible_assets.index', $client)->with('alert', $response);
    }
}
