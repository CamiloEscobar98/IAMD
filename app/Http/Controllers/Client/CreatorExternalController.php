<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Client\Creators\External\StoreRequest;
use App\Http\Requests\Client\Creators\External\UpdateRequest;

use App\Services\Client\CreatorExternalService;

use App\Repositories\Client\CreatorExternalRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CreatorExternalController extends Controller
{
    /** @var CreatorExternalService */
    protected $creatorExternalService;

    /** @var CreatorExternalRepository */
    protected $creatorExternalRepository;

    public function __construct(
        CreatorExternalService $creatorExternalService,
        CreatorExternalRepository $creatorExternalRepository,
    ) {
        $this->middleware('auth');

        $this->middleware('permission:creators.external.index')->only('index');
        $this->middleware('permission:creators.external.show')->only('show');
        $this->middleware('permission:creators.external.store')->only(['create', 'store']);
        $this->middleware('permission:creators.external.update')->only(['edit', 'update']);
        $this->middleware('permission:creators.external.destroy')->only('destroy');

        $this->creatorExternalService = $creatorExternalService;
        $this->creatorExternalRepository = $creatorExternalRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param string $client
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {
        try {
            $params = $this->creatorExternalService->transformParams($request->all());
            $query = $this->creatorExternalRepository->search($params, [
                'creator', 'external_organization', 'assignment_contract', 'creator.document',
                'creator.document.document_type', 'creator.document.expedition_place'
            ]);
            $total = $query->count();
            $items = $this->creatorExternalService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.creators.external.index', compact('links'))
                ->nest('filters', 'client.pages.creators.external.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.creators.external.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Index/Exception: {$e->getMessage()}");
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
            $item = $this->creatorExternalRepository->newInstance();
            return view('client.pages.creators.external.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.creators.external.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->creatorExternalService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/CreatorExternalController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.creators.external.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param string $external
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $external, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->creatorExternalRepository->getByIdWithRelations($external, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place.state.country',
                'external_organization', 'assignment_contract'
            ], 'creator_id');
            return view('client.pages.creators.external.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.creators.external.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param string $external
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $external, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->creatorExternalRepository->getByIdWithRelations($external, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
                'external_organization', 'assignment_contract'
            ], 'creator_id');
            return view('client.pages.creators.external.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.creators.external.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int $client
     * @param string $external
     * 
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $external): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->creatorExternalService->update($request->all(), $external);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/CreatorExternalController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.creators.external.edit', compact('client', 'external'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param string $external
     * @return RedirectResponse
     */
    public function destroy($client, $external): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->creatorExternalRepository->getById($external);
            DB::beginTransaction();
            $this->creatorExternalService->delete($external);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/CreatorExternalController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorExternalController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.creators.external.index', $client)->with('alert', $response);
    }
}
