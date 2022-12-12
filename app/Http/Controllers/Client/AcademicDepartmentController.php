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
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $params = $this->academicDepartmentService->transformParams($request->all());

            $query = $this->academicDepartmentRepository->search($params, [], ['research_units']);

            $total = $query->count();

            $items = $this->academicDepartmentService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.academic_departments.index')
                ->nest('filters', 'client.pages.academic_departments.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.academic_departments.components.table', compact('items', 'links'));
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
            $item = $this->academicDepartmentRepository->newInstance();
            return view('client.pages.academic_departments.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();

            $item = DB::transaction(function () use ($data) {
                return $this->academicDepartmentRepository->create($data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.academic_departments.messages.save_success', ['academic_department' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.academic_departments.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $academic_department
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $academic_department, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->academicDepartmentRepository->getById($academic_department);


            return view('client.pages.academic_departments.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $request->client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id, $academic_department, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->academicDepartmentRepository->getById($academic_department);


            return view('client.pages.academic_departments.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $request->client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id, $academic_department): RedirectResponse
    {
        try {
            $data = $request->all();

            $item = $this->academicDepartmentRepository->getById($academic_department);

            DB::transaction(function () use ($data, $item) {
                return $this->academicDepartmentRepository->update($item, $data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.academic_departments.messages.update_success', ['academic_department' => $item->name])]);
        } catch (\Exception $th) {
            dd($th->getMessage());
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.academic_departments.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id, $academic_department): RedirectResponse
    {
        try {
            $item = $this->academicDepartmentRepository->getById($academic_department);

            DB::beginTransaction();

            $this->academicDepartmentRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.academic_departments.messages.delete_success', ['academic_department' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.academic_departments.messages.delete_error')]);
        }
    }
}
