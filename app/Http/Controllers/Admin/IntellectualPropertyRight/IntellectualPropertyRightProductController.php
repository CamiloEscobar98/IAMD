<?php

namespace App\Http\Controllers\Admin\IntellectualPropertyRight;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\IntellectualPropertyRights\Products\StoreRequest;
use App\Http\Requests\Admin\IntellectualPropertyRights\Products\UpdateRequest;

use App\Services\Admin\IntellectualPropertyRightProductService;

use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class IntellectualPropertyRightProductController extends Controller
{
    /** @var IntellectualPropertyRightProductService */
    protected $intellectualPropertyRightProductService;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    public function __construct(
        IntellectualPropertyRightProductService $intellectualPropertyRightProductService,

        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository
    ) {
        $this->middleware('auth:admin');

        $this->intellectualPropertyRightProductService = $intellectualPropertyRightProductService;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
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
            $params = $this->intellectualPropertyRightProductService->transformParams($request->all());
            $query = $this->intellectualPropertyRightProductRepository->search($params, ['intellectual_property_right_subcategory.intellectual_property_right_category']);
            $total = $query->count();
            $items = $this->intellectualPropertyRightProductService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('admin.pages.intellectual_property_rights.products.index', compact('links'))
                ->nest('filters', 'admin.pages.intellectual_property_rights.products.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intellectual_property_rights.products.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.intellectual_property_rights.products.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse|View
     */
    public function create()
    {
        try {
            $item = $this->intellectualPropertyRightProductRepository->newInstance();
            return view('admin.pages.intellectual_property_rights.products.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * 
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->intellectualPropertyRightProductService->save($request->all());
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
        return redirect()->route('admin.intellectual_property_rights.products.create')->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse|View
     */
    public function show($id) #: RedirectResponse|View
    {
        try {
            $item = $this->intellectualPropertyRightProductRepository->search(['id' => $id], ['intellectual_property_right_subcategory.intellectual_property_right_category'],)->first();
            return view('admin.pages.intellectual_property_rights.products.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->intellectualPropertyRightProductRepository->getById($id);

            return view('admin.pages.intellectual_property_rights.products.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Admin/IntellectualPropertyRight/IntellectualPropertyRightSubcategoryController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->intellectualPropertyRightProductService->update($request->all(), $id);
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
        return redirect()->route('admin.intellectual_property_rights.products.edit', $id)->with('alert', $response);
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
            $item = $this->intellectualPropertyRightProductRepository->getById($id);
            DB::beginTransaction();
            $this->intellectualPropertyRightProductService->delete($id);
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
        return redirect()->route('admin.intellectual_property_rights.products.index')->with('alert', $response);
    }
}
