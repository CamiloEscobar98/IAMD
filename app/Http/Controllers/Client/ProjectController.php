<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Client\Projects\StoreRequest;
use App\Http\Requests\Client\Projects\UpdateRequest;

use App\Services\Client\ProjectService;

use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\ProjectFinancingRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /** @var ProjectService */
    protected $projectService;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var ProjectFinancingRepository */
    protected $projectFinancingRepository;

    public function __construct(
        ProjectService $projectService,

        ProjectRepository $projectRepository,
        ProjectFinancingRepository $projectFinancingRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:projects.index')->only('index');
        $this->middleware('permission:projects.show')->only('show');
        $this->middleware('permission:projects.store')->only(['create', 'store']);
        $this->middleware('permission:projects.update')->only(['edit', 'update']);
        $this->middleware('permission:projects.destroy')->only('destroy');

        $this->projectService = $projectService;

        $this->projectRepository = $projectRepository;
        $this->projectFinancingRepository = $projectFinancingRepository;
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
            $params = $this->projectService->transformParams($request->all());
            $query = $this->projectRepository->search(
                $params,
                ['project_financings:id,name,code', 'director:id,name', 'contract_type:id,name,code'],
                ['intangible_assets']
            );
            $total = $query->count();
            $items = $this->projectService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.projects.index', compact('links'))
                ->nest('filters', 'client.pages.projects.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.projects.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ProjectController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $client
     * @return \Illuminate\Http\Response
     */
    public function create($client): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->projectRepository->newInstance();
            return view('client.pages.projects.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.projects.create', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->projectService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/ProjectController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ProjectController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.projects.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param string $client
     * @param int $project
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($client, $project, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->projectRepository->getByIdWithRelations($project, ['director', 'research_units', 'intangible_assets', 'project_financings', 'contract_type']);
            return view('client.pages.projects.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ProjectController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.projects.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $client
     * @param int $project
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($client, $project, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->projectRepository->getByIdWithRelations($project, ['director', 'research_units', 'intangible_assets', 'project_financings', 'contract_type']);
            return view('client.pages.projects.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ProjectController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.projects.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @param int $project
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $client, $project): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->projectService->update($request->all(), $project);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/ProjectController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ProjectController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ProjectController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.projects.edit', compact('client', 'project'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($client, $project)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->projectRepository->getById($project);
            DB::beginTransaction();
            $this->projectService->delete($project);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/ProjectController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ProjectController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ProjectController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ProjectController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.projects.index', $client)->with('alert', $response);
    }
}
