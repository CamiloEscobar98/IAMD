<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\FinancingTypes\StoreRequest;
use App\Http\Requests\Client\FinancingTypes\UpdateRequest;

use App\Services\Client\FinancingTypeService;

use App\Repositories\Client\FinancingTypeRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class FinancingTypeController extends Controller
{
    /** @var FinancingTypeService */
    protected $financingTypeService;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    public function __construct(
        FinancingTypeService $financingTypeService,
        FinancingTypeRepository $financingTypeRepository
    ) {
        $this->middleware('auth');

        $this->financingTypeService = $financingTypeService;
        $this->financingTypeRepository = $financingTypeRepository;
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
            $params = $this->financingTypeService->transformParams($request->all());
            $query = $this->financingTypeRepository->search($params);
            $total = $query->count();
            $items = $this->financingTypeService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.financing_types.index')
                ->nest('filters', 'client.pages.financing_types.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.financing_types.components.table', compact('items', 'links'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->financingTypeRepository->newInstance();
            return view('client.pages.financing_types.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.financing_types.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->financingTypeService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/FinancingTypeController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.financing_types.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $financingType): View|RedirectResponse
    {
        try {
            $item = $this->financingTypeRepository->getById($financingType);

            return view('client.pages.financing_types.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.financing_types.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $financingType): View|RedirectResponse
    {
        try {
            $item = $this->financingTypeRepository->getById($financingType);
            return view('client.pages.financing_types.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.financing_types.show', compact('client', 'financing_type'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int $client
     * @param int $financingType
     * 
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $financingType): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->financingTypeService->update($request->all(), $financingType);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/FinancingTypeController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.financing_types.edit', compact('client', 'financing_type'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function destroy($client, $financingType): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->financingTypeRepository->getById($financingType);
            DB::beginTransaction();
            $this->financingTypeService->delete($financingType);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/FinancingTypeController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/FinancingTypeController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.financing_types.index', $client)->with('alert', $response);
    }
}
