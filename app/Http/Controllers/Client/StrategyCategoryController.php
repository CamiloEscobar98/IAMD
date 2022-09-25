<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\StrategyCategories\StoreRequest;
use App\Http\Requests\Client\StrategyCategories\UpdateRequest;

use App\Services\Client\StrategyCategoryService;

use App\Repositories\Client\StrategyCategoryRepository;

class StrategyCategoryController extends Controller
{
    /** @var StrategyCategoryService */
    protected $strategyCategoryService;

    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    public function __construct(
        StrategyCategoryService $strategyCategoryService,
        StrategyCategoryRepository $strategyCategoryRepository
    ) {
        $this->middleware('auth');
        
        $this->strategyCategoryService = $strategyCategoryService;
        $this->strategyCategoryRepository = $strategyCategoryRepository;
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
            $params = $this->strategyCategoryService->transformParams($request->all());

            $query = $this->strategyCategoryRepository->search($params, [], []);

            $total = $query->count();

            $items = $this->strategyCategoryService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.strategy_categories.index')
                ->nest('filters', 'client.pages.strategy_categories.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.strategy_categories.components.table', compact('items', 'links'));
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
            return view('client.pages.strategy_categories.create');
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

            $item = $this->strategyCategoryRepository->create($data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.strategy_categories.messages.save_success', ['strategy' => $item->name])]);
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
            $item = $this->strategyCategoryRepository->getById($strategy);

            return view('client.pages.strategy_categories.show', compact('item'));
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
            $item = $this->strategyCategoryRepository->getById($strategy);

            return view('client.pages.strategy_categories.edit', compact('item'));
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

            $item = $this->strategyCategoryRepository->getById($strategy);

            $this->strategyCategoryRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.strategy_categories.messages.update_success', ['strategy' => $item->name])]);
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
            $item = $this->strategyCategoryRepository->getById($strategy);

            DB::beginTransaction();

            $this->strategyCategoryRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.strategy_categories.messages.delete_success', ['strategy' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
