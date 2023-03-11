<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Client\AdministrativeUnits\StoreRequest;
use App\Http\Requests\Client\AdministrativeUnits\UpdateRequest;

use App\Services\Client\AdministrativeUnitService;

use App\Repositories\Client\AdministrativeUnitRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AdministrativeUnitController extends Controller
{
    /** @var AdministrativeUnitService */
    protected $administrativeUnitService;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    public function __construct(
        AdministrativeUnitService $administrativeUnitService,
        AdministrativeUnitRepository $administrativeUnitRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:administrative_units.index')->only('index');
        $this->middleware('permission:administrative_units.show')->only('show');
        $this->middleware('permission:administrative_units.store')->only(['create', 'store']);
        $this->middleware('permission:administrative_units.update')->only(['edit', 'update']);
        $this->middleware('permission:administrative_units.destroy')->only('destroy');

        $this->administrativeUnitService = $administrativeUnitService;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client) #: View|RedirectResponse
    {
        try {
            $params = $this->administrativeUnitService->transformParams($request->all());
            $query = $this->administrativeUnitRepository->search($params, [], ['research_units']);
            $total = $query->count();
            $items = $this->administrativeUnitService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.administrative_units.index', compact('links'))
                ->nest('filters', 'client.pages.administrative_units.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.administrative_units.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     *@param string $client
     * @return View|RedirectResponse
     */
    public function create($client): View|RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->newInstance();
            return view('client.pages.administrative_units.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.administrative_units.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->administrativeUnitService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/AdministrativeUnitController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.administrative_units.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param string $client
     * @param  int $administrative_unit
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $administrative_unit, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->getById($administrative_unit);
            return view('client.pages.administrative_units.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.administrative_units.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $client
     * @param  int $administrative_unit
     * @return View|RedirectResponse
     */
    public function edit($client, $administrative_unit, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->getById($administrative_unit);
            return view('client.pages.administrative_units.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.administrative_units.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @param int $administrative_unit
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $administrative_unit): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->administrativeUnitService->update($request->all(), $administrative_unit);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/AdministrativeUnitController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.administrative_units.edit', compact('client', 'administrative_unit'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $client
     * @param int $administrative_unit
     * @return RedirectResponse
     */
    public function destroy($client, $administrative_unit): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->administrativeUnitRepository->getById($administrative_unit);
            DB::beginTransaction();
            $this->administrativeUnitService->delete($administrative_unit);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/AdministrativeUnitController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/AdministrativeUnitController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.administrative_units.index', $client)->with('alert', $response);
    }
}
