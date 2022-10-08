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
            $params = $this->intellectualPropertyRightProductService->transformParams($request->all());

            $query = $this->intellectualPropertyRightProductRepository->search($params, [ 'intellectual_property_right_subcategory.intellectual_property_right_category']);

            $total = $query->count();

            $items = $this->intellectualPropertyRightProductService->customPagination($query, $params, $request->get('page'), $total);

            // return $items;

            $links = $items->links('pagination.customized');

            return view('admin.pages.intellectual_property_rights.products.index', compact('links'))
                ->nest('filters', 'admin.pages.intellectual_property_rights.products.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intellectual_property_rights.products.components.table', compact('items'));
        } catch (\Exception $th) {
            dd($th->getMessage());
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
            $item = $this->intellectualPropertyRightProductRepository->newInstance();
            return view('admin.pages.intellectual_property_rights.products.create', compact('item'));
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

            $item = $this->intellectualPropertyRightProductRepository->create($data);

            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.products.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.products.messages.save_success', ['product' => $item->name])]);
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
    public function show($id)#: RedirectResponse|View
    {
        try {
            $data['id'] = $id;

            $item = $this->intellectualPropertyRightProductRepository->search($data, ['intellectual_property_right_subcategory.intellectual_property_right_category'], )->first();

            return view('admin.pages.intellectual_property_rights.products.show', compact('item'));
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
            $item = $this->intellectualPropertyRightProductRepository->getById($id);

            return view('admin.pages.intellectual_property_rights.products.edit', compact('item'));
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

            $item = $this->intellectualPropertyRightProductRepository->getById($id);

            DB::beginTransaction();

            $this->intellectualPropertyRightProductRepository->update($item, $data);

            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.products.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.products.messages.update_success', ['product' => $item->name])]);
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
            $item = $this->intellectualPropertyRightProductRepository->getById($id);
            DB::beginTransaction();
            $this->intellectualPropertyRightProductRepository->delete($item);
            DB::commit();

            return redirect()->route('admin.intellectual_property_rights.products.index')->with('alert', ['title' => '', 'icon' => 'success', 'text' => __('pages.admin.intellectual_property_rights.products.messages.delete_success', ['category' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }
}
