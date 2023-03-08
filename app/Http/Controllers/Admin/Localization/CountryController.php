<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Admin\Localizations\Countries\StoreRequest;
use App\Http\Requests\Admin\Localizations\Countries\UpdateRequest;

use App\Services\Admin\CountryService;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;
use App\Services\Admin\StateService;
use Exception;

class CountryController extends Controller
{
    /** @var CountryService */
    protected $countryService;

    /** @var StateService */
    protected $stateService;

    /** @var StateRepository */
    protected $stateRepository;

    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(
        CountryService $countryService,
        StateService $stateService,
        StateRepository $stateRepository,
        CountryRepository $countryRepository,
    ) {
        $this->middleware('auth:admin');

        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->stateRepository = $stateRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $params = $this->countryService->transformParams($request->all());
            $query = $this->countryRepository->search($params, [], ['states', 'cities']);
            $total = $query->count();
            $items = $this->countryService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.localization.countries.index', compact('links'))
                ->nest('filters', 'admin.pages.localization.countries.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.localization.countries.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            $item = $this->countryRepository->newInstance();
            return view('admin.pages.localization.countries.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->countryService->save($request->only('name'));
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Admin/Localizations/CountryController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.localizations.countries.create')->with('alert', $response);
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
            $item = $this->countryRepository->getById($id);

            $params = $this->stateService->transformParams($request->all());
            $params['id'] = $id;
            $query = $this->stateRepository->search($params, ['cities'], ['cities']);
            $total = $query->count();
            $items = $this->stateService->customPagination($query, $params, 10, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.localization.countries.show', compact('item', 'total', 'items', 'links'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.localizations.countries.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.not_found')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit(Request $request, $id): View|RedirectResponse
    {
        try {
            $item = $this->countryRepository->getById($id);
            return view('admin.pages.localization.countries.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.not_found')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->countryService->update($request->all(), $id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Admin/Localizations/CountryController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.localizations.countries.edit', $id)->with('alert', $response);
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
            $item = $this->countryRepository->getById($id);
            DB::beginTransaction();
            $this->countryService->delete($id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Admin/Localizations/CountryController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Localizations/CountryController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.localizations.countries.index')->with('alert', $response);
    }
}
