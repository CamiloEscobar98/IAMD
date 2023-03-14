<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\PriorityTools\StoreRequest;
use App\Http\Requests\Client\PriorityTools\UpdateRequest;

use App\Services\Client\PriorityToolService;

use App\Repositories\Client\PriorityToolRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PriorityToolController extends Controller
{
    /** @var PriorityToolService */
    protected $priorityToolService;

    /** @var PriorityToolRepository */
    protected $priorityToolRepository;

    public function __construct(
        PriorityToolService $priorityToolService,
        PriorityToolRepository $priorityToolRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:priority_tools.index')->only('index');
        $this->middleware('permission:priority_tools.show')->only('show');
        $this->middleware('permission:priority_tools.store')->only(['create', 'store']);
        $this->middleware('permission:priority_tools.update')->only(['edit', 'update']);
        $this->middleware('permission:priority_tools.destroy')->only('destroy');

        $this->priorityToolService = $priorityToolService;
        $this->priorityToolRepository = $priorityToolRepository;
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
            $params = $this->priorityToolService->transformParams($request->all());
            $query = $this->priorityToolRepository->search($params);
            $total = $query->count();
            $items = $this->priorityToolService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.priority_tools.index')
                ->nest('filters', 'client.pages.priority_tools.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.priority_tools.components.table', compact('items', 'links'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Index/Exception: {$e->getMessage()}");
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
            $item = $this->priorityToolRepository->newInstance();
            return view('client.pages.priority_tools.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.priority_tools.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->priorityToolService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/PriorityToolController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.priority_tools.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $priorityTool
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $priorityTool): View|RedirectResponse
    {
        try {
            $item = $this->priorityToolRepository->getById($priorityTool);
            return view('client.pages.priority_tools.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.priority_tools.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $priority_tool
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $priority_tool): View|RedirectResponse
    {
        try {
            $item = $this->priorityToolRepository->getById($priority_tool);
            return view('client.pages.priority_tools.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.priority_tools.show', ['priority_tool' => $priority_tool, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param int $client
     * @param int $priority_tool
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $client, $priority_tool): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->priorityToolService->update($request->all(), $priority_tool);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/PriorityToolController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.priority_tools.edit', compact('client', 'priority_tool'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $priority_tool
     * 
     * @return RedirectResponse
     */
    public function destroy($client, $priority_tool): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->priorityToolRepository->getById($priority_tool);
            DB::beginTransaction();
            $this->priorityToolService->delete($priority_tool);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/PriorityToolController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/PriorityToolController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.priority_tools.index', $client)->with('alert', $response);
    }
}
