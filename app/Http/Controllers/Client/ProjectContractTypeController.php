<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\ProjectContractTypes\StoreRequest;
use App\Http\Requests\Client\ProjectContractTypes\UpdateRequest;

use App\Services\Client\ProjectContractTypeService;

use App\Repositories\Client\ProjectContractTypeRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ProjectContractTypeController extends Controller
{
    /** @var ProjectContractTypeService */
    protected $projectContractTypeService;

    /** @var ProjectContractTypeRepository */
    protected $projectContractTypeRepository;

    public function __construct(
        ProjectContractTypeService $projectContractTypeService,
        ProjectContractTypeRepository $projectContractTypeRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:project_contract_types.index')->only('index');
        $this->middleware('permission:project_contract_types.show')->only('show');
        $this->middleware('permission:project_contract_types.store')->only(['create', 'store']);
        $this->middleware('permission:project_contract_types.update')->only(['edit', 'update']);
        $this->middleware('permission:project_contract_types.destroy')->only('destroy');

        $this->projectContractTypeService = $projectContractTypeService;
        $this->projectContractTypeRepository = $projectContractTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param strign $client
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {
        try {
            $params = $this->projectContractTypeService->transformParams($request->all());
            $query = $this->projectContractTypeRepository->search($params);
            $total = $query->count();
            $items = $this->projectContractTypeService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.project_contract_types.index')
                ->nest('filters', 'client.pages.project_contract_types.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.project_contract_types.components.table', compact('items', 'links'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Index/Exception: {$e->getMessage()}");
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
            $item = $this->projectContractTypeRepository->newInstance();
            return view('client.pages.project_contract_types.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.project_contract_types.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->projectContractTypeService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/ProjectContractTypeController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.project_contract_types.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $project_contract_type
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $project_contract_type): View|RedirectResponse
    {
        try {
            $item = $this->projectContractTypeRepository->getById($project_contract_type);
            return view('client.pages.project_contract_types.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.project_contract_types.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $project_contract_type
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $project_contract_type): View|RedirectResponse
    {
        try {
            $item = $this->projectContractTypeRepository->getById($project_contract_type);
            return view('client.pages.project_contract_types.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.project_contract_types.show', compact('client', 'project_contract_type'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int $client
     * @param int $project_contract_type
     * 
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $project_contract_type): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->projectContractTypeService->update($request->all(), $project_contract_type);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/ProjectContractTypeController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.project_contract_types.edit', compact('client', 'project_contract_type'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $project_contract_type
     * 
     * @return View|RedirectResponse
     */
    public function destroy($client, $project_contract_type): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->projectContractTypeRepository->getById($project_contract_type);
            DB::beginTransaction();
            $this->projectContractTypeService->delete($project_contract_type);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/ProjectContractTypeController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectContractTypeController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.project_contract_types.index', $client)->with('alert', $response);
    }
}
