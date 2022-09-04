<?php

namespace App\Http\Controllers\Admin\Creator;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Creator\AssignmentContracts\StoreRequest;
use App\Http\Requests\Admin\Creator\AssignmentContracts\UpdateRequest;

use App\Repositories\Admin\AssignmentContractRepository;

use App\Services\Admin\AssignmentContractService;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $params = $this->assignmentContractService->transformParams($request->all());

            $query = $this->assignmentContractRepository->search($params);

            $total = $query->count();

            $items = $this->assignmentContractService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            $types = [['id' => 2, 'name' => __('admin_pages.creators.assignment_contracts.options.external')], ['id' => 1, 'name' => __('admin_pages.creators.assignment_contracts.options.internal')]];

            return view('admin.pages.creators.assignment_contracts.index', compact('links'))
                ->nest('filters', 'admin.pages.creators.assignment_contracts.components.filters', compact('params', 'total', 'types'))
                ->nest('table', 'admin.pages.creators.assignment_contracts.components.table', compact('items'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $types = [['id' => 0, 'name' => __('admin_pages.creators.assignment_contracts.options.external')], ['id' => 1, 'name' => __('admin_pages.creators.assignment_contracts.options.internal')]];
            $editMode = false;

            return view('admin.pages.creators.assignment_contracts.create')
                ->nest('form', 'admin.pages.creators.assignment_contracts.components.form', compact('editMode', 'types'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->all();

            $item = DB::transaction(function () use ($data) {
                return $this->assignmentContractRepository->create($data);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.creators.assignment_contracts.messages.save_success', ['assignment_contract' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.creators.assignment_contracts.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->assignmentContractRepository->getById($id);

            return view('admin.pages.creators.assignment_contracts.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $item = $this->assignmentContractRepository->getById($id);

            $types = [['id' => 0, 'name' => __('admin_pages.creators.assignment_contracts.options.external')], ['id' => 1, 'name' => __('admin_pages.creators.assignment_contracts.options.internal')]];
            $editMode = true;

            return view('admin.pages.creators.assignment_contracts.edit', compact('item'))
                ->nest('form', 'admin.pages.creators.assignment_contracts.components.form', compact('editMode', 'types', 'item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();

            $item = $this->assignmentContractRepository->getById($id);

            DB::transaction(function () use ($item, $data) {
                $this->assignmentContractRepository->update($item, $data);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.creators.assignment_contracts.messages.update_success', ['assignment_contract' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.creators.assignment_contracts.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = $this->assignmentContractRepository->getById($id);

            DB::transaction(function () use ($item) {
                $this->assignmentContractRepository->delete($item);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.creators.assignment_contracts.messages.delete_success', ['assignment_contract' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.creators.assignment_contracts.messages.delete_error')]);
        }
    }
}
