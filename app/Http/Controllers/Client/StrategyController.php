<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\Strategies\StoreRequest;
use App\Http\Requests\Client\Strategies\UpdateRequest;

use App\Services\Client\StrategyService;

use App\Repositories\Client\StrategyRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class StrategyController extends Controller
{
    /** @var StrategyService */
    protected $strategyService;

    /** @var StrategyRepository */
    protected $strategyRepository;

    public function __construct(
        StrategyService $strategyService,
        StrategyRepository $strategyRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:strategies.index')->only('index');
        $this->middleware('permission:strategies.show')->only('show');
        $this->middleware('permission:strategies.store')->only(['create', 'store']);
        $this->middleware('permission:strategies.update')->only(['edit', 'update']);
        $this->middleware('permission:strategies.destroy')->only('destroy');

        $this->strategyService = $strategyService;
        $this->strategyRepository = $strategyRepository;
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
            $params = $this->strategyService->transformParams($request->all());
            $query = $this->strategyRepository->search($params);
            $total = $query->count();
            $items = $this->strategyService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.strategies.index')
                ->nest('filters', 'client.pages.strategies.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.strategies.components.table', compact('items', 'links'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/StrategyController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyController:Index/Exception: {$e->getMessage()}");
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
            $item = $this->strategyRepository->newInstance();
            return view('client.pages.strategies.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.strategies.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * 
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->strategyService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/StrategyController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/StrategyController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.strategies.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $strategy): View|RedirectResponse
    {
        try {
            $item = $this->strategyRepository->getById($strategy);
            return view('client.pages.strategies.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/StrategyController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.strategies.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $strategy): View|RedirectResponse
    {
        try {
            $item = $this->strategyRepository->getById($strategy);
            return view('client.pages.strategies.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/StrategyController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.strategies.show', ['strategy' => $strategy, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int $client
     * @return RedirectResponse
     */
    public function update(Request $request, $client, $strategy): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->strategyService->update($request->all(), $strategy);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/StrategyController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/StrategyController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/StrategyController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.strategies.edit', compact('client', 'strategy'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function destroy($client, $strategy): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->strategyRepository->getById($strategy);
            DB::beginTransaction();
            $this->strategyService->delete($strategy);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/StrategyController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/StrategyController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/StrategyController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/StrategyController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.strategies.index', $client)->with('alert', $response);
    }
}
