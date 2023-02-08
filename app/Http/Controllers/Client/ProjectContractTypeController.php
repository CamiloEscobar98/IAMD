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
            [$params, $total, $items, $links] = $this->projectContractTypeService->searchWithPagination($request->all(), $request->get('page'));
            return view('client.pages.project_contract_types.index')
                ->nest('filters', 'client.pages.project_contract_types.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.project_contract_types.components.table', compact('items', 'links'));
        } catch (\Exception $e) {
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
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
        } catch (\Exception $th) {
            return redirect()->route('client.project_contract_types.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
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
        return redirect()->route('client.project_contract_types.create', $client)->with('alert', $this->projectContractTypeService->save($request->all()));
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
        } catch (\Exception $th) {
            return redirect()->route('client.project_contract_types.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
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
        } catch (\Exception $th) {
            return redirect()->route('client.project_contract_types.show', ['project_contract_type' => $project_contract_type, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
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
    public function update(Request $request, $client, $project_contract_type): RedirectResponse
    {
        return redirect()->route('client.project_contract_types.edit', ['project_contract_type' => $project_contract_type, 'client' => $client])
            ->with('alert', $this->projectContractTypeService->update($request->all(), $project_contract_type));
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
        return redirect()->route('client.project_contract_types.index', $client)->with('alert', $this->projectContractTypeService->delete($project_contract_type));
    }
}
