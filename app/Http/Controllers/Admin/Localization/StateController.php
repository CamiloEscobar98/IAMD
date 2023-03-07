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
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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
            $params = $this->stateService->transformParams($request->all());
            $query = $this->stateRepository->search($params, ['cities'], ['cities']);
            $total = $query->count();
            $items = $this->stateService->customPagination($query, $params, 10, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.localization.states.index', compact('links'))
                ->nest('filters', 'admin.pages.localization.states.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.localization.states.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/StateController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/StateController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.localizations.states.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        try {
            $item = $this->stateRepository->newInstance();
            return view('admin.pages.localization.states.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/StateController:Create/Exception: {$e->getMessage()}");
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $this->stateService->save($request->only('name', 'country_id'));
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/StateController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/StateController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.localizations.states.create')->with('alert', $response);
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
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/StateController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/StateController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.not_found')]);
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
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/StateController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/StateController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.not_found')]);
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
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $this->stateService->update($request->only('name'), $id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/StateController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/StateController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/StateController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.localizations.states.edit', $id)->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->stateRepository->getById($id);
            DB::beginTransaction();
            $this->stateService->delete($id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            // Log::info("@Web/Controllers/StateController:Delete/Success", $item->toArray());
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/StateController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/StateController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/StateController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.localizations.states.index')->with('alert', $response);
    }
}
