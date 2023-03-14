<?php

namespace App\Http\Controllers\Admin\Creator;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Creator\ExternalOrganizations\StoreRequest;
use App\Http\Requests\Admin\Creator\ExternalOrganizations\UpdateRequest;

use App\Repositories\Admin\ExternalOrganizationRepository;

use App\Services\Admin\ExternalOrganizationService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ExternalOrganizationController extends Controller
{
    /** @var ExternalOrganizationService */
    protected $externalOrganizationService;

    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    public function __construct(
        ExternalOrganizationService $externalOrganizationService,
        ExternalOrganizationRepository $externalOrganizationRepository
    ) {
        $this->middleware('auth:admin');
        $this->externalOrganizationService = $externalOrganizationService;
        $this->externalOrganizationRepository = $externalOrganizationRepository;
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
            $params = $this->externalOrganizationService->transformParams($request->all());
            $query = $this->externalOrganizationRepository->search($params);
            $total = $query->count();
            $items = $this->externalOrganizationService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.creators.external_organizations.index', compact('links'))
                ->nest('filters', 'admin.pages.creators.external_organizations.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.creators.external_organizations.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.creators.external_organizations.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            $item = $this->externalOrganizationRepository->newInstance();
            return view('admin.pages.creators.external_organizations.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $this->externalOrganizationService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.creators.external_organizations.create')->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function show($id): View|RedirectResponse
    {
        try {
            $item = $this->externalOrganizationRepository->getById($id);
            return view('admin.pages.creators.external_organizations.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->externalOrganizationRepository->getById($id);
            return view('admin.pages.creators.external_organizations.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $this->externalOrganizationService->update($request->all(), $id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.creators.external_organizations.edit', $id)->with('alert', $response);
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
            /** @var \App\Models\Admin\ExternalOrganization $item */
            $item = $this->externalOrganizationRepository->getById($id);
            DB::beginTransaction();
            $this->externalOrganizationService->delete($id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Admin/Creators/DocumentTypeController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/Creators/DocumentTypeController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.creators.external_organizations.index')->with('alert', $response);
    }
}
