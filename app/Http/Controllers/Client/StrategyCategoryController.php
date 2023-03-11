<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\StrategyCategories\StoreRequest;
use App\Http\Requests\Client\StrategyCategories\UpdateRequest;

use App\Services\Client\StrategyCategoryService;

use App\Repositories\Client\StrategyCategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class StrategyCategoryController extends Controller
{
    /** @var StrategyCategoryService */
    protected $strategyCategoryService;

    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    public function __construct(
        StrategyCategoryService $strategyCategoryService,
        StrategyCategoryRepository $strategyCategoryRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:strategy_categories.index')->only('index');
        $this->middleware('permission:strategy_categories.show')->only('show');
        $this->middleware('permission:strategy_categories.store')->only(['create', 'store']);
        $this->middleware('permission:strategy_categories.update')->only(['edit', 'update']);
        $this->middleware('permission:strategy_categories.destroy')->only('destroy');

        $this->strategyCategoryService = $strategyCategoryService;
        $this->strategyCategoryRepository = $strategyCategoryRepository;
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
            $params = $this->strategyCategoryService->transformParams($request->all());
            $query = $this->strategyCategoryRepository->search($params);
            $total = $query->count();
            $items = $this->strategyCategoryService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.strategy_categories.index')
                ->nest('filters', 'client.pages.strategy_categories.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.strategy_categories.components.table', compact('items', 'links'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Index/Exception: {$e->getMessage()}");
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
            $item = $this->strategyCategoryRepository->newInstance();
            return view('client.pages.strategy_categories.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.strategy_categories.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->strategyCategoryService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/StrategyCategoryController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.strategy_categories.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param int  $client
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $strategy): View|RedirectResponse
    {
        try {
            $item = $this->strategyCategoryRepository->getById($strategy);
            return view('client.pages.strategy_categories.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.strategy_categories.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  $client
     * @param int $strategy_category
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $strategy_category): View|RedirectResponse
    {
        try {
            $item = $this->strategyCategoryRepository->getById($strategy_category);
            return view('client.pages.strategy_categories.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.strategy_categories.show', ['strategy_category' => $strategy_category, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int  $client
     * @param int $strategy_category
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $client, $strategy_category): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->strategyCategoryService->update($request->all(), $strategy_category);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/StrategyCategoryController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.strategy_categories.edit', compact('client', 'strategy_category'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  $client
     * @param int $strategy_category
     * 
     * @return RedirectResponse
     */
    public function destroy($client, $strategy_category): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->strategyCategoryRepository->getById($strategy_category);
            DB::beginTransaction();
            $this->strategyCategoryService->delete($strategy_category);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/StrategyCategoryController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyCategoryController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.strategy_categories.index', $client)->with('alert', $response);
    }
}
