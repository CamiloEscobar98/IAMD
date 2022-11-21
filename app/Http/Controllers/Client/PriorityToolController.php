<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\PriorityTools\StoreRequest;
use App\Http\Requests\Client\PriorityTools\UpdateRequest;

use App\Services\Client\PriorityToolService;

use App\Repositories\Client\PriorityToolRepository;
use Illuminate\Support\Facades\DB;

class PriorityToolController extends Controller
{
    /** @var PriorityToolService */
    protected $priorityToolService;

    /** @var PriorityToolRepository */
    protected $priorityToolRepository;

    public function __construct(
        PriorityToolService $priorityToolService,
        PriorityToolRepository $priorityToolRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:priority_tools.index')->only('index');
        $this->middleware('permission:priority_tools.show')->only('show');
        $this->middleware('permission:priority_tools.store')->only(['create', 'store']);
        $this->middleware('permission:priority_tools.update')->only(['edit', 'update']);
        $this->middleware('permission:priority_tools.destroy')->only('destroy');

        $this->priorityToolService = $priorityToolService;
        $this->priorityToolRepository = $priorityToolRepository;
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
            $params = $this->priorityToolService->transformParams($request->all());

            $query = $this->priorityToolRepository->search($params, [], []);

            $total = $query->count();

            $items = $this->priorityToolService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.priority_tools.index')
                ->nest('filters', 'client.pages.priority_tools.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.priority_tools.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return $th->getMessage();
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
            $item = $this->priorityToolRepository->newInstance();
            return view('client.pages.priority_tools.create', compact('item'));
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
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->all();

            DB::beginTransaction();

            $item = $this->priorityToolRepository->create($data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.priority_tools.messages.save_success', ['priority_tool' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.priority_tools.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $priorityTool
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $priorityTool): View|RedirectResponse
    {
        try {
            $item = $this->priorityToolRepository->getById($priorityTool);

            return view('client.pages.priority_tools.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $priorityTool
     * 
     * @return View|RedirectResponse
     */
    public function edit($id, $priorityTool): View|RedirectResponse
    {
        try {
            $item = $this->priorityToolRepository->getById($priorityTool);

            return view('client.pages.priority_tools.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  int  $id
     * @param int $priorityTool
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $id, $priorityTool): RedirectResponse
    {
        try {
            $data = $request->all();

            DB::beginTransaction();

            $item = $this->priorityToolRepository->getById($priorityTool);

            $this->priorityToolRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.priority_tools.messages.update_success', ['priority_tool' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.priority_tools.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $priorityTool
     * 
     * @return RedirectResponse
     */
    public function destroy($id, $priorityTool): RedirectResponse
    {
        try {
            $item = $this->priorityToolRepository->getById($priorityTool);

            DB::beginTransaction();

            $this->priorityToolRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.priority_tools.messages.delete_success', ['priority_tool' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.priority_tools.messages.delete_error')]);
        }
    }
}
