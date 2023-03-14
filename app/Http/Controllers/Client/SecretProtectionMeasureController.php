<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Http\Request;

use App\Http\Requests\Client\SecretProtectionMeasures\StoreRequest;
use App\Http\Requests\Client\SecretProtectionMeasures\UpdateRequest;

use App\Services\Client\SecretProtectionMeasureService;
use App\Repositories\Client\SecretProtectionMeasureRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class SecretProtectionMeasureController extends Controller
{
    /** @var SecretProtectionMeasureService */
    protected $secretProtectionMeasureService;

    /** @var SecretProtectionMeasureRepository */
    protected $secretProtectionMeasureRepository;

    public function __construct(
        SecretProtectionMeasureService $secretProtectionMeasureService,
        SecretProtectionMeasureRepository $secretProtectionMeasureRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:secret_protection_measures.index')->only('index');
        $this->middleware('permission:secret_protection_measures.show')->only('show');
        $this->middleware('permission:secret_protection_measures.store')->only(['create', 'store']);
        $this->middleware('permission:secret_protection_measures.update')->only(['edit', 'update']);
        $this->middleware('permission:secret_protection_measures.destroy')->only('destroy');

        $this->secretProtectionMeasureService = $secretProtectionMeasureService;
        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
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
            $params = $this->secretProtectionMeasureService->transformParams($request->all());
            $query = $this->secretProtectionMeasureRepository->search($params);
            $total = $query->count();
            $items = $this->secretProtectionMeasureService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            [$params, $total, $items, $links] = $this->secretProtectionMeasureService->searchWithPagination($request->all(), $request->get('page', 1));
            return view('client.pages.secret_protection_measures.index')
                ->nest('filters', 'client.pages.secret_protection_measures.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.secret_protection_measures.components.table', compact('items', 'links'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Index/Exception: {$e->getMessage()}");
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
            $item = $this->secretProtectionMeasureRepository->newInstance();
            return view('client.pages.secret_protection_measures.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.secret_protection_measures.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->secretProtectionMeasureService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/SecretProtectionMeasureController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.secret_protection_measures.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $secretProtectionMeasure
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $secretProtectionMeasure): View|RedirectResponse
    {
        try {
            $item = $this->secretProtectionMeasureRepository->getById($secretProtectionMeasure);
            return view('client.pages.secret_protection_measures.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.secret_protection_measures.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $secret_protection_measure
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $secret_protection_measure): View|RedirectResponse
    {
        try {
            $item = $this->secretProtectionMeasureRepository->getById($secret_protection_measure);
            return view('client.pages.secret_protection_measures.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.secret_protection_measures.show', compact('client', 'secret_protection_measure'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int $client
     * @param $secret_protection_measure
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $client, $secret_protection_measure): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->secretProtectionMeasureService->update($request->all(), $secret_protection_measure);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/SecretProtectionMeasureController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.secret_protection_measures.edit', compact('client', 'secret_protection_measure'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $secret_protection_measure
     * 
     * @return View|RedirectResponse
     */
    public function destroy($client, $secret_protection_measure): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->secretProtectionMeasureRepository->getById($secret_protection_measure);
            DB::beginTransaction();
            $this->secretProtectionMeasureService->delete($secret_protection_measure);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/SecretProtectionMeasureController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/SecretProtectionMeasureController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.secret_protection_measures.index', $client)->with('alert', $response);
    }
}
