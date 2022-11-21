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
     * 
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $params = $this->strategyService->transformParams($request->all());

            $query = $this->strategyRepository->search($params, [], []);

            $total = $query->count();

            $items = $this->strategyService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.strategies.index')
                ->nest('filters', 'client.pages.strategies.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.strategies.components.table', compact('items', 'links'));
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
            $item = $this->strategyRepository->newInstance();
            return view('client.pages.strategies.create', compact('item'));
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
    public function store(StoreRequest $request): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->strategyRepository->create($data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.strategies.messages.save_success', ['strategy' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $strategy): View|RedirectResponse
    {
        try {
            $item = $this->strategyRepository->getById($strategy);

            return view('client.pages.strategies.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function edit($id, $strategy): View|RedirectResponse
    {
        try {
            $item = $this->strategyRepository->getById($strategy);

            return view('client.pages.strategies.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $id, $strategy): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->strategyRepository->getById($strategy);

            $this->strategyRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.strategies.messages.update_success', ['strategy' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $strategy
     * 
     * @return View|RedirectResponse
     */
    public function destroy($id, $strategy): RedirectResponse
    {
        try {
            $item = $this->strategyRepository->getById($strategy);

            DB::beginTransaction();

            $this->strategyRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.strategies.messages.delete_success', ['strategy' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
