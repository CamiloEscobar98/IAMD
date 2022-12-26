<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Admin\Localizations\States\StoreRequest;
use App\Http\Requests\Admin\Localizations\States\UpdateRequest;

use App\Services\Admin\StateService;

use App\Repositories\Admin\StateRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StateController extends Controller
{
    /** @var StateService */
    protected $stateService;

    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(
        StateService $stateService,

        StateRepository $stateRepository,
    ) {
        $this->middleware('auth:admin');

        $this->stateService = $stateService;

        $this->stateRepository = $stateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {

            [$params, $total, $items, $links] = $this->stateService->searchWithPagination($request->all(), $request->get('page'), ['cities'], ['cities']);
            return view('admin.pages.localization.states.index', compact('links'))
                ->nest('filters', 'admin.pages.localization.states.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.localization.states.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.localizations.states.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $item = $this->stateRepository->newInstance();
        return view('admin.pages.localization.states.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return redirect()->route('admin.localizations.states.create')->with('alert', $this->stateService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function show(Request $request, $id): View|RedirectResponse
    {
        try {
            $item = $this->stateRepository->getById($id);
            return view('admin.pages.localization.states.show', compact('item'));
        } catch (ModelNotFoundException $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.not_found')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id): View|RedirectResponse
    {
        try {
            $item = $this->stateRepository->getById($id);
            return view('admin.pages.localization.states.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.not_found')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        return redirect()->route('admin.localizations.states.edit', $id)->with('alert', $this->stateService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        return redirect()->route('admin.localizations.states.index')->with('alert', $this->stateService->delete($id));
    }
}
