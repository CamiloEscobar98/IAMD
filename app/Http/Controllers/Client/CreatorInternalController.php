<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Client\Creators\Internal\StoreRequest;
use App\Http\Requests\Client\Creators\Internal\UpdateRequest;

use App\Services\Client\CreatorInternalService;

use App\Repositories\Client\CreatorInternalRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CreatorInternalController extends Controller
{
    /** @var CreatorInternalService */
    protected $creatorInternalService;

    /** @var CreatorInternalRepository */
    protected $creatorInternalRepository;

    public function __construct(
        CreatorInternalService $creatorInternalService,
        CreatorInternalRepository $creatorInternalRepository,
    ) {
        $this->middleware('auth');

        $this->middleware('permission:creators.internal.index')->only('index');
        $this->middleware('permission:creators.internal.show')->only('show');
        $this->middleware('permission:creators.internal.store')->only(['create', 'store']);
        $this->middleware('permission:creators.internal.update')->only(['edit', 'update']);
        $this->middleware('permission:creators.internal.destroy')->only('destroy');

        $this->creatorInternalService = $creatorInternalService;

        $this->creatorInternalRepository = $creatorInternalRepository;
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
            $params = $this->creatorInternalService->transformParams($request->all());
            $query = $this->creatorInternalRepository->search($params, [
                'creator', 'linkage_type', 'assignment_contract', 'creator.document',
                'creator.document.document_type', 'creator.document.expedition_place'
            ]);
            $total = $query->count();
            $items = $this->creatorInternalService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.creators.internal.index', compact('links'))
                ->nest('filters', 'client.pages.creators.internal.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.creators.internal.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     * @param string $client
     * @return View|RedirectResponse
     */
    public function create($client): View|RedirectResponse
    {
        try {
            $item = $this->creatorInternalRepository->newInstance();
            return view('client.pages.creators.internal.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.creators.internal.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->creatorInternalService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/CreatorInternalController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.creators.internal.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $client
     * @param int $internal
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $internal, Request $request) #: View|RedirectResponse
    {
        try {
            $item = $this->creatorInternalRepository->getByIdWithRelations($internal, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place.state.country',
                'linkage_type', 'assignment_contract'
            ], 'creator_id');
            return view('client.pages.creators.internal.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.creators.internal.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @param int $internal
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $internal, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->creatorInternalRepository->getByIdWithRelations($internal, [
                'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
                'linkage_type', 'assignment_contract'
            ], 'creator_id');

            return view('client.pages.creators.internal.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.creators.internal.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @param int $internal
     * 
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $internal): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->creatorInternalService->update($request->all(), $internal);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/CreatorInternalController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.creators.internal.edit', compact('client', 'internal'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @param int $internal
     * @return RedirectResponse
     */
    public function destroy($client, $internal): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->creatorInternalRepository->getById($internal);
            DB::beginTransaction();
            $this->creatorInternalService->delete($internal);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/CreatorInternalController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/CreatorInternalController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.creators.internal.index', $client)->with('alert', $response);
    }
}
