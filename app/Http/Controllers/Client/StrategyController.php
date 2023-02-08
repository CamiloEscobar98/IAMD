<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\Strategies\StoreRequest;
use App\Http\Requests\Client\Strategies\UpdateRequest;

use App\Services\Client\StrategyService;

use App\Repositories\Client\StrategyRepository;

class StrategyController extends Controller
{
    /** @var StrategyService */
    protected $strategyService;

    /** @var StrategyRepository */
    protected $strategyRepository;

    public function __construct(
        StrategyService $strategyService,
        StrategyRepository $strategyRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:strategies.index')->only('index');
        $this->middleware('permission:strategies.show')->only('show');
        $this->middleware('permission:strategies.store')->only(['create', 'store']);
        $this->middleware('permission:strategies.update')->only(['edit', 'update']);
        $this->middleware('permission:strategies.destroy')->only('destroy');

        $this->strategyService = $strategyService;
        $this->strategyRepository = $strategyRepository;
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
            [$params, $total, $items, $links] = $this->strategyService->searchWithPagination($request->all(), $request->get('page'));
            return view('client.pages.strategies.index')
                ->nest('filters', 'client.pages.strategies.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.strategies.components.table', compact('items', 'links'));
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
            $item = $this->strategyRepository->newInstance();
            return view('client.pages.strategies.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.strategies.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * 
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        return redirect()->route('client.strategies.create', $client)->with('alert', $this->strategyService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $strategy): View|RedirectResponse
    {
        try {
            $item = $this->strategyRepository->getById($strategy);
            return view('client.pages.strategies.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.strategies.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $strategy): View|RedirectResponse
    {
        try {
            $item = $this->strategyRepository->getById($strategy);
            return view('client.pages.strategies.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.strategies.show', ['strategy' => $strategy, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int $client
     * @return RedirectResponse
     */
    public function update(Request $request, $client, $strategy): RedirectResponse
    {
        return redirect()->route('client.strategies.edit', ['strategy' => $strategy, 'client' => $client])
            ->with('alert', $this->strategyService->update($request->all(), $strategy));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function destroy($client, $strategy): RedirectResponse
    {
        return redirect()->route('client.strategies.index', $client)->with('alert', $this->strategyService->delete($strategy));
    }
}
