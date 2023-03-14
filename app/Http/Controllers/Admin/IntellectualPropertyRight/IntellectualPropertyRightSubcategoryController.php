<?php

namespace App\Http\Controllers\Admin\IntellectualPropertyRight;

use App\Http\Controllers\Controller;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\IntellectualPropertyRights\Subcategories\StoreRequest;
use App\Http\Requests\Admin\IntellectualPropertyRights\Subcategories\UpdateRequest;

use App\Services\Admin\IntellectualPropertyRightSubcategoryService;

use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IntellectualPropertyRightSubcategoryController extends Controller
{
    /** @var IntellectualPropertyRightSubcategoryService */
    protected $intellectualPropertyRightSubcategoryService;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    public function __construct(
        IntellectualPropertyRightSubcategoryService $intellectualPropertyRightSubcategoryService,

        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository
    ) {
        $this->middleware('auth:admin');

        $this->intellectualPropertyRightSubcategoryService = $intellectualPropertyRightSubcategoryService;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     *
     * @return RedirectResponse|View
     */
    public function index(Request $request) #: RedirectResponse|View
    {
        try {
            $params = $this->intellectualPropertyRightSubcategoryService->transformParams($request->all());
            $query = $this->intellectualPropertyRightSubcategoryRepository->search($params, ['intellectual_property_right_category'], ['intellectual_property_right_products',]);
            $total = $query->count();
            $items = $this->intellectualPropertyRightSubcategoryService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.intellectual_property_rights.subcategories.index', compact('links'))
                ->nest('filters', 'admin.pages.intellectual_property_rights.subcategories.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intellectual_property_rights.subcategories.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse|View
     */
    public function create()
    {
        try {
            $item = $this->intellectualPropertyRightSubcategoryRepository->newInstance();
            return view('admin.pages.intellectual_property_rights.subcategories.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->intellectualPropertyRightSubcategoryService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intellectual_property_rights.subcategories.create')->with('alert', $response);
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
            $item = $this->intellectualPropertyRightSubcategoryRepository->search(['id' => $id], ['intellectual_property_right_category'], ['intellectual_property_right_products'])->first();
            return view('admin.pages.intellectual_property_rights.subcategories.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->intellectualPropertyRightSubcategoryRepository->getById($id);
            return view('admin.pages.intellectual_property_rights.subcategories.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->intellectualPropertyRightSubcategoryService->update($request->all(), $id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intellectual_property_rights.subcategories.edit', $id)->with('alert', $response);
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
            $item = $this->intellectualPropertyRightSubcategoryRepository->getById($id);
            DB::beginTransaction();
            $this->intellectualPropertyRightSubcategoryService->delete($id);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', $response);
    }
}
