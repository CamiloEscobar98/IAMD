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
            $item = $this->intellectualPropertyRightCategoryRepository->newInstance();
            return view('admin.pages.intellectual_property_rights.categories.create', compact('item'));
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

            $item = $this->intellectualPropertyRightCategoryRepository->create($data);

            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.categories.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.categories.messages.save_success', ['category' => $item->name])]);
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

            $item = $this->intellectualPropertyRightCategoryRepository->search($data, [], ['intellectual_property_right_subcategories', 'intellectual_property_right_products'])->first();

            return view('admin.pages.intellectual_property_rights.categories.show', compact('item'));
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
            $item = $this->intellectualPropertyRightCategoryRepository->getById($id);

            return view('admin.pages.intellectual_property_rights.categories.edit', compact('item'));
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
            
            $item = $this->intellectualPropertyRightCategoryRepository->getById($id);
            
            DB::beginTransaction();

            $this->intellectualPropertyRightCategoryRepository->update($item, $data);

            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.categories.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.categories.messages.update_success', ['category' => $item->name])]);
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
            $item = $this->intellectualPropertyRightCategoryRepository->getById($id);
            DB::beginTransaction();
            $this->intellectualPropertyRightCategoryRepository->delete($item);
            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.categories.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.categories.messages.delete_success', ['category' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }
}
