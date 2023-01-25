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
            [$params, $total, $items, $links] = $this->assignmentContractService->searchWithPagination($request->all(), $request->get('page'));
            return view('admin.pages.creators.assignment_contracts.index', compact('links'))
                ->nest('filters', 'admin.pages.creators.assignment_contracts.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.creators.assignment_contracts.components.table', compact('items'));
        } catch (\Exception $th) {
            dd($th->getMessage());
            return redirect()->route('admin.creators.assignment_contracts.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->assignmentContractRepository->newInstance();
            return view('admin.pages.creators.assignment_contracts.create', compact('item'));
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
        return redirect()->route('admin.creators.assignment_contracts.create')->with('alert', $this->assignmentContractService->save($request->all()));
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
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.not_found')]);
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
            return view('admin.pages.creators.assignment_contracts.edit', compact('item'))
                ->nest('form', 'admin.pages.creators.assignment_contracts.components.form', compact('item'));
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
        return redirect()->route('admin.creators.assignment_contracts.edit', $id)->with('alert', $this->assignmentContractService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('admin.creators.assignment_contracts.index')->with('alert', $this->assignmentContractService->delete($id));
    }
}
