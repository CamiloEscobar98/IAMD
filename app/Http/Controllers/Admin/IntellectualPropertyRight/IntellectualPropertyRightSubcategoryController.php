<?php

namespace App\Http\Controllers\Admin\IntellectualPropertyRight;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\IntellectualPropertyRights\Subcategories\StoreRequest;
use App\Http\Requests\Admin\IntellectualPropertyRights\Subcategories\UpdateRequest;

use App\Services\Admin\IntellectualPropertyRightSubcategoryService;

use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;

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

            $query = $this->intellectualPropertyRightSubcategoryRepository->search($params, ['intellectual_property_right_category'], ['intellectual_property_right_products']);

            $total = $query->count();

            $items = $this->intellectualPropertyRightSubcategoryService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('admin.pages.intellectual_property_rights.subcategories.index', compact('links'))
                ->nest('filters', 'admin.pages.intellectual_property_rights.subcategories.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intellectual_property_rights.subcategories.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
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
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
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
        try {
            $data = $request->all();

            DB::beginTransaction();

            $item = $this->intellectualPropertyRightSubcategoryRepository->create($data);

            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.subcategories.messages.save_success', ['subcategory' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
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
            $data['id'] = $id;

            $item = $this->intellectualPropertyRightSubcategoryRepository->search($data, ['intellectual_property_right_category'], ['intellectual_property_right_products'])->first();

            return view('admin.pages.intellectual_property_rights.subcategories.show', compact('item'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
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
        } catch (\Throwable $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
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
        try {
            $data = $request->all();

            $item = $this->intellectualPropertyRightSubcategoryRepository->getById($id);

            DB::beginTransaction();

            $this->intellectualPropertyRightSubcategoryRepository->update($item, $data);

            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.subcategories.messages.update_success', ['category' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|View
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $item = $this->intellectualPropertyRightSubcategoryRepository->getById($id);
            DB::beginTransaction();
            $this->intellectualPropertyRightSubcategoryRepository->delete($item);
            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.subcategories.messages.delete_success', ['subcategory' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }
}
