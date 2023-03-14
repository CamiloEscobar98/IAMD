<?php

namespace App\Http\Controllers\Admin\Creator;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Creator\AssignmentContracts\StoreRequest;
use App\Http\Requests\Admin\Creator\AssignmentContracts\UpdateRequest;

use App\Repositories\Admin\AssignmentContractRepository;

use App\Services\Admin\AssignmentContractService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AssignmentContractController extends Controller
{
    /** @var AssignmentContractService */
    protected $assignmentContractService;

    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    public function __construct(
        AssignmentContractService $assignmentContractService,
        AssignmentContractRepository $assignmentContractRepository
    ) {
        $this->middleware('auth:admin');

        $this->assignmentContractService = $assignmentContractService;
        $this->assignmentContractRepository = $assignmentContractRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $params = $this->assignmentContractService->transformParams($request->all());
            $query = $this->assignmentContractRepository->search($params);
            $total = $query->count();
            $items = $this->assignmentContractService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.creators.assignment_contracts.index', compact('links'))
                ->nest('filters', 'admin.pages.creators.assignment_contracts.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.creators.assignment_contracts.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.creators.assignment_contracts.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            $item = $this->assignmentContractRepository->newInstance();
            return view('admin.pages.creators.assignment_contracts.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $this->assignmentContractService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.creators.assignment_contracts.create')->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $assignmentContract
     * @return View|RedirectResponse 
     */
    public function show($assignmentContract): View|RedirectResponse
    {
        try {
            $item = $this->assignmentContractRepository->getById($assignmentContract);
            return view('admin.pages.creators.assignment_contracts.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.not_found')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $assignmentContract
     * @return View|RedirectResponse
     */
    public function edit($assignmentContract): View|RedirectResponse
    {
        try {
            $item = $this->assignmentContractRepository->getById($assignmentContract);
            return view('admin.pages.creators.assignment_contracts.edit', compact('item'))
                ->nest('form', 'admin.pages.creators.assignment_contracts.components.form', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $assignmentContract
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $assignmentContract): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $this->assignmentContractService->update($request->all(), $assignmentContract);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.creators.assignment_contracts.edit', $assignmentContract)->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $assignmentContract
     * @return RedirectResponse
     */
    public function destroy($assignmentContract): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->assignmentContractRepository->getById($assignmentContract);
            DB::beginTransaction();
            $this->assignmentContractService->delete($assignmentContract);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Admin/Creators/AssignmentContractController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/AssignmentContractController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.creators.assignment_contracts.index')->with('alert', $response);
    }
}
