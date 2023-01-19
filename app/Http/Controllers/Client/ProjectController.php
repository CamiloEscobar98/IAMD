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
     * @param string $client
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, $client) #: \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->projectService->searchWithPagination(
                $request->all(),
                $request->get('page'),
                ['project_financings:id,name,code', 'director:id,name', 'contract_type:id,name,code'],
                ['intangible_assets']
            );
            return view('client.pages.projects.index', compact('links'))
                ->nest('filters', 'client.pages.projects.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.projects.components.table', compact('items'));
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->projectRepository->newInstance();
            return view('client.pages.projects.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
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
        return redirect()->route('client.projects.create', $client)->with('alert', $this->projectService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $project
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id, $project, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->projectRepository->getByIdWithRelations($project, ['director', 'intangible_assets', 'project_financing.financing_type', 'project_financing.project_contract_type']);
            return view('client.pages.projects.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $project
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, $project, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->projectRepository->getByIdWithRelations($project, ['project_financing']);

            return view('client.pages.projects.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param int $project
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id, $project): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {

            $dataProject = $request->only(['research_unit_id', 'director_id', 'name', 'description']);

            $item = $this->projectRepository->getById($project);

            DB::beginTransaction();

            $this->projectRepository->update($item, $dataProject);

            $dataProjectFinancing = $request->only(['financing_type_id', 'project_contract_type_id', 'contract', 'date']);

            $projectFinancing = $this->projectFinancingRepository->getById($project);

            $this->projectFinancingRepository->update($projectFinancing, $dataProjectFinancing);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.projects.messages.update_success', ['project' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.projects.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $project)
    {
        try {
            $item = $this->projectRepository->getById($project);

            DB::beginTransaction();

            $this->projectRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.projects.messages.delete_success', ['project' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.projects.messages.delete_error')]);
        }
    }
}
