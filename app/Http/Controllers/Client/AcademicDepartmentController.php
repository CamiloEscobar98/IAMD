<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\AcademicDepartments\StoreRequest;
use App\Http\Requests\Client\AcademicDepartments\UpdateRequest;

use App\Services\Client\AcademicDepartmentService;

use App\Repositories\Client\AcademicDepartmentRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AcademicDepartmentController extends Controller
{
    /** @var AcademicDepartmentService */
    protected $academicDepartmentService;

    /** @var AcademicDepartmentRepository */
    protected $academicDepartmentRepository;

    public function __construct(AcademicDepartmentService $academicDepartmentService, AcademicDepartmentRepository $academicDepartmentRepository)
    {
        $this->middleware('auth');

        $this->middleware('permission:academic_departments.index')->only('index');
        $this->middleware('permission:academic_departments.show')->only('show');
        $this->middleware('permission:academic_departments.store')->only(['create', 'store']);
        $this->middleware('permission:academic_departments.update')->only(['edit', 'update']);
        $this->middleware('permission:academic_departments.destroy')->only('destroy');

        $this->academicDepartmentService = $academicDepartmentService;
        $this->academicDepartmentRepository = $academicDepartmentRepository;
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
            $params = $this->academicDepartmentService->transformParams($request->all());
            $query = $this->academicDepartmentRepository->search($params, [], ['research_units']);
            $total = $query->count();
            $items = $this->academicDepartmentService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.academic_departments.index', compact('links'))
                ->nest('filters', 'client.pages.academic_departments.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.academic_departments.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Index/Exception: {$e->getMessage()}");
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
            $item = $this->academicDepartmentRepository->newInstance();
            return view('client.pages.academic_departments.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.academic_departments.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->academicDepartmentService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/AdministrativeUnitController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.academic_departments.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $academic_department
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $academic_department, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->academicDepartmentRepository->getById($academic_department);
            return view('client.pages.academic_departments.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.academic_departments.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $client
     * @param int $academic_department
     * @return View|RedirectResponse
     */
    public function edit($client, $academic_department, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->academicDepartmentRepository->getById($academic_department);
            return view('client.pages.academic_departments.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.academic_departments.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $client
     * @param int $academic_department
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $academic_department): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->academicDepartmentService->update($request->all(), $academic_department);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/AdministrativeUnitController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.academic_departments.edit', compact('client', 'academic_department'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $client
     * @paeram int $academic_department
     * @return RedirectResponse
     */
    public function destroy($client, $academic_department): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->academicDepartmentRepository->getById($academic_department);
            DB::beginTransaction();
            $this->academicDepartmentService->delete($academic_department);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/AdministrativeUnitController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.academic_departments.index', $client)->with('alert', $response);
    }
}
