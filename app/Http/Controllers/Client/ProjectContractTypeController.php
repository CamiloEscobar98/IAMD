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

        $this->projectContractTypeService = $projectContractTypeService;
        $this->projectContractTypeRepository = $projectContractTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $params = $this->projectContractTypeService->transformParams($request->all());

            $query = $this->projectContractTypeRepository->search($params, [], []);

            $total = $query->count();

            $items = $this->projectContractTypeService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.project_contract_types.index')
                ->nest('filters', 'client.pages.project_contract_types.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.project_contract_types.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            $item = $this->projectContractTypeRepository->newInstance();
            return view('client.pages.project_contract_types.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * 
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->projectContractTypeRepository->create($data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.project_contract_types.messages.save_success', ['project_contract_type' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $projectContractType
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $projectContractType): View|RedirectResponse
    {
        try {
            $item = $this->projectContractTypeRepository->getById($projectContractType);

            return view('client.pages.project_contract_types.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $projectContractType
     * 
     * @return View|RedirectResponse
     */
    public function edit($id, $projectContractType): View|RedirectResponse
    {
        try {
            $item = $this->projectContractTypeRepository->getById($projectContractType);

            return view('client.pages.project_contract_types.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $id, $projectContractType): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->projectContractTypeRepository->getById($projectContractType);

            $this->projectContractTypeRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.project_contract_types.messages.update_success', ['project_contract_type' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $projectContractType
     * 
     * @return View|RedirectResponse
     */
    public function destroy($id, $projectContractType): RedirectResponse
    {
        try {
            $item = $this->projectContractTypeRepository->getById($projectContractType);

            DB::beginTransaction();

            $this->projectContractTypeRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.project_contract_types.messages.delete_success', ['project_contract_type' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
