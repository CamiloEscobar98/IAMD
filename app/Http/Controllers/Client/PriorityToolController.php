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
     * @param string $client
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->priorityToolService->searchWithPagination($request->all(), $request->get('page'));
            return view('client.pages.priority_tools.index')
                ->nest('filters', 'client.pages.priority_tools.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.priority_tools.components.table', compact('items', 'links'));
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
            $item = $this->priorityToolRepository->newInstance();
            return view('client.pages.priority_tools.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.priority_tools.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client)
    {
        return redirect()->route('client.priority_tools.create', $client)->with('alert', $this->priorityToolService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $priorityTool
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $priorityTool): View|RedirectResponse
    {
        try {
            $item = $this->priorityToolRepository->getById($priorityTool);
            return view('client.pages.priority_tools.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.priority_tools.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $priority_tool
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $priority_tool): View|RedirectResponse
    {
        try {
            $item = $this->priorityToolRepository->getById($priority_tool);
            return view('client.pages.priority_tools.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.priority_tools.show', ['priority_tool' => $priority_tool, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param int $client
     * @param int $priority_tool
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $client, $priority_tool): RedirectResponse
    {
        return redirect()->route('client.priority_tools.edit', ['priority_tool' => $priority_tool, 'client' => $client])
            ->with('alert', $this->priorityToolService->update($request->all(), $priority_tool));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $priority_tool
     * 
     * @return RedirectResponse
     */
    public function destroy($client, $priority_tool): RedirectResponse
    {
        return redirect()->route('client.priority_tools.index', $client)->with('alert', $this->priorityToolService->delete($priority_tool));
    }
}
