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
            [$params, $total, $items, $links] = $this->academicDepartmentService->searchWithPagination($request->all(), $request->get('page'), [], ['research_units']);
            return view('client.pages.academic_departments.index', compact('links'))
                ->nest('filters', 'client.pages.academic_departments.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.academic_departments.components.table', compact('items'));
        } catch (\Exception $th) {
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
            $item = $this->academicDepartmentRepository->newInstance();
            return view('client.pages.academic_departments.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.academic_departments.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
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
        return redirect()->route('client.academic_departments.create', $client)->with('alert', $this->academicDepartmentService->save($request->all()));
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
        } catch (\Exception $th) {
            return redirect()->route('client.academic_departments.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @return View|RedirectResponse
     */
    public function edit($client, $academic_department, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->academicDepartmentRepository->getById($academic_department);
            return view('client.pages.academic_departments.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.academic_departments.show', ['academic_department' => $academic_department, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $academic_department): RedirectResponse
    {
        return redirect()->route('client.academic_departments.edit', ['academic_department' => $academic_department, 'client' => $client])->with('alert', $this->academicDepartmentService->update($request->all(), $academic_department));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @return RedirectResponse
     */
    public function destroy($client, $academic_department): RedirectResponse
    {
        return redirect()->route('client.academic_departments.index', $client)->with('alert', $this->academicDepartmentService->delete($academic_department));
    }
}
