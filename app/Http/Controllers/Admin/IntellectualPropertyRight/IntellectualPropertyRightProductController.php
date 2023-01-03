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
            [$params, $total, $items, $links] = $this->intellectualPropertyRightProductService->searchWithPagination($request->all(), $request->get('page'), ['intellectual_property_right_subcategory.intellectual_property_right_category']);
            return view('admin.pages.intellectual_property_rights.products.index', compact('links'))
                ->nest('filters', 'admin.pages.intellectual_property_rights.products.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intellectual_property_rights.products.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.intellectual_property_rights.products.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->intellectualPropertyRightProductRepository->newInstance();
            return view('admin.pages.intellectual_property_rights.products.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
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
        return redirect()->route('admin.intellectual_property_rights.products.create')->with('alert', $this->intellectualPropertyRightProductService->save($request->all()));
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
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->intellectualPropertyRightProductRepository->getById($id);

            return view('admin.pages.intellectual_property_rights.products.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        return redirect()->route('admin.intellectual_property_rights.products.edit', $id)->with('alert', $this->intellectualPropertyRightProductService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|View
     */
    public function destroy($id): RedirectResponse
    {
        return redirect()->route('admin.intellectual_property_rights.products.index')->with('alert', $this->intellectualPropertyRightProductService->delete($id));
    }
}
