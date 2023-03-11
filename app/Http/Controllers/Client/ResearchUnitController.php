<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Client\ResearchUnits\StoreRequest;
use App\Http\Requests\Client\ResearchUnits\UpdateRequest;

use App\Services\Client\ResearchUnitService;

use App\Repositories\Client\ResearchUnitRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ResearchUnitController extends Controller
{
    /** @var ResearchUnitService */
    protected $researchUnitService;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(
        ResearchUnitService $researchUnitService,
        ResearchUnitRepository $researchUnitRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:research_units.index')->only('index');
        $this->middleware('permission:research_units.show')->only('show');
        $this->middleware('permission:research_units.store')->only(['create', 'store']);
        $this->middleware('permission:research_units.update')->only(['edit', 'update']);
        $this->middleware('permission:research_units.destroy')->only('destroy');

        $this->researchUnitService = $researchUnitService;
        $this->researchUnitRepository = $researchUnitRepository;
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param string $client     
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {
        try {
            $params = $this->researchUnitService->transformParams($request->all());
            $query = $this->researchUnitRepository->search(
                $params,
                ['administrative_unit', 'research_unit_category', 'director', 'inventory_manager'],
                ['projects']
            );
            $total = $query->count();
            $items = $this->researchUnitService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.research_units.index')
                ->nest('filters', 'client.pages.research_units.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.research_units.components.table', compact('items', 'links'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            $item = $this->researchUnitRepository->newInstance();
            return view('client.pages.research_units.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->researchUnitService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/ResearchUnitController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.research_units.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $client
     * @return View|RedirectResponse
     */
    public function show($client, $research_unit, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->researchUnitRepository->getByIdWithRelations($research_unit, ['administrative_unit', 'research_unit_category', 'director', 'inventory_manager']);
            return view('client.pages.research_units.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @return View|RedirectResponse
     */
    public function edit($client, $research_unit, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->researchUnitRepository->getById($research_unit);
            return view('client.pages.research_units.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @return View|RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $research_unit): View|RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->researchUnitService->update($request->all(), $research_unit);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/ResearchUnitController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.research_units.edit', compact('research_unit', 'client'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @param int $research_unit
     * @return View|RedirectResponse
     */
    public function destroy($client, $research_unit)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->researchUnitRepository->getById($research_unit);
            DB::beginTransaction();
            $this->researchUnitService->delete($research_unit);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/ResearchUnitController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/ResearchUnitController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.research_units.index', $client)->with('alert', $response);
    }
}
