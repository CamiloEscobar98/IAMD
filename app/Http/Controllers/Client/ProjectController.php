<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Client\Projects\StoreRequest;
use App\Http\Requests\Client\Projects\UpdateRequest;

use App\Services\Client\ProjectService;

use App\Repositories\Client\ProjectRepository;

class ProjectController extends Controller
{

    /** @var ProjectService */
    protected $projectService;

    /** @var ProjectRepository */
    protected $projectRepository;

    public function __construct(
        ProjectService $projectService,
        ProjectRepository $projectRepository
    ) {
        $this->middleware('auth');

        $this->projectService = $projectService;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            $params = $this->projectService->transformParams($request->all());

            $query = $this->projectRepository->search($params, [], ['intangible_assets']);

            $total = $query->count();

            $items = $this->projectService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.projects.index')
                ->nest('filters', 'client.pages.projects.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.projects.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
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
            return view('client.pages.projects.create');
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $data = $request->all();

            DB::beginTransaction();

            $item = $this->projectRepository->create($data);

            DB::commit();
            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.projects.messages.save_success', ['project' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id, $project, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->projectRepository->getByIdWithRelations($project, ['research_unit', 'director']);

            return view('client.pages.projects.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $project, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->projectRepository->getById($project);


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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id, $project): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $data = $request->all();

            $item = $this->projectRepository->getById($project);

            DB::beginTransaction();

            $this->projectRepository->update($item, $data);

            DB::commit();

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.projects.messages.update_success', ['project' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.projects.messages.update_error')]);
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

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.projects.messages.delete_success', ['project' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.projects.messages.delete_error')]);
        }
    }
}
