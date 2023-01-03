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
            [$params, $total, $items, $links] = $this->intellectualPropertyRightSubcategoryService->searchWithPagination($request->all(), $request->get('page'), ['intellectual_property_right_category'], ['intellectual_property_right_products',]);
            return view('admin.pages.intellectual_property_rights.subcategories.index', compact('links'))
                ->nest('filters', 'admin.pages.intellectual_property_rights.subcategories.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intellectual_property_rights.subcategories.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        return redirect()->route('admin.intellectual_property_rights.subcategories.create')->with('alert', $this->intellectualPropertyRightSubcategoryService->save($request->all()));
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
        } catch (\Exception $th) {
            return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        } catch (\Exception $th) {
            return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        return redirect()->route('admin.intellectual_property_rights.subcategories.edit', $id)->with('alert', $this->intellectualPropertyRightSubcategoryService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|View
     */
    public function destroy($id): RedirectResponse
    {
        return redirect()->route('admin.intellectual_property_rights.subcategories.index')->with('alert', $this->intellectualPropertyRightSubcategoryService->delete($id));
    }
}
