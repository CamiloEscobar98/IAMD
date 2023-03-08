<?php

namespace App\Http\Controllers\Admin\IntellectualPropertyRight;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\IntellectualPropertyRights\Categories\StoreRequest;
use App\Http\Requests\Admin\IntellectualPropertyRights\Categories\UpdateRequest;

use App\Services\Admin\IntellectualPropertyRightCategoryService;

use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class IntellectualPropertyRightCategoryController extends Controller
{
    /** @var IntellectualPropertyRightCategoryService */
    protected $intellectualPropertyRightCategoryService;

    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

    public function __construct(
        IntellectualPropertyRightCategoryService $intellectualPropertyRightCategoryService,

        IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository
    ) {
        $this->middleware('auth:admin');

        $this->intellectualPropertyRightCategoryService = $intellectualPropertyRightCategoryService;
        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     *
     * @return RedirectResponse|View
     */
    public function index(Request $request): RedirectResponse|View
    {
        try {
            $params = $this->intellectualPropertyRightCategoryService->transformParams($request->all());
            $query = $this->intellectualPropertyRightCategoryRepository->search($params, [], ['intellectual_property_right_subcategories', 'intellectual_property_right_products']);
            $total = $query->count();
            $items = $this->intellectualPropertyRightCategoryService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.intellectual_property_rights.categories.index', compact('links'))
                ->nest('filters', 'admin.pages.intellectual_property_rights.categories.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intellectual_property_rights.categories.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.categories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse|View
     */
    public function create()
    {
        try {
            $item = $this->intellectualPropertyRightCategoryRepository->newInstance();
            return view('admin.pages.intellectual_property_rights.categories.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.categories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * 
     * @return RedirectResponse|View
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->intellectualPropertyRightCategoryService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intellectual_property_rights.categories.create')->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse|View
     */
    public function show($id): RedirectResponse|View
    {
        try {
            $item = $this->intellectualPropertyRightCategoryRepository->search(['id' => $id], [], ['intellectual_property_right_subcategories', 'intellectual_property_right_products'])->first();
            return view('admin.pages.intellectual_property_rights.categories.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.categories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse|View
     */
    public function edit($id): RedirectResponse|View
    {
        try {
            $item = $this->intellectualPropertyRightCategoryRepository->getById($id);
            return view('admin.pages.intellectual_property_rights.categories.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.categories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * 
     * @return RedirectResponse|View
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->intellectualPropertyRightCategoryService->update($request->all(), $id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intellectual_property_rights.categories.edit', $id)->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|View
     */
    public function destroy($id): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->intellectualPropertyRightCategoryRepository->getById($id);
            DB::beginTransaction();
            $this->intellectualPropertyRightCategoryService->delete($id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightCategoryController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intellectual_property_rights.categories.index')->with('alert', $response);
    }
}
