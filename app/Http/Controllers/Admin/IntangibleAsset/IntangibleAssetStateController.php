<?php

namespace App\Http\Controllers\Admin\IntangibleAsset;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\IntangibleAssets\States\StoreRequest;

use App\Http\Requests\Admin\IntangibleAssets\States\UpdateRequest;

use App\Services\Admin\IntangibleAssetStateService;

use App\Repositories\Admin\IntangibleAssetStateRepository;

class IntangibleAssetStateController extends Controller
{
    /** @var IntangibleAssetStateService */
    protected $intangibleAssetStateService;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    public function __construct(
        IntangibleAssetStateService $intangibleAssetStateService,
        IntangibleAssetStateRepository $intangibleAssetStateRepository
    ) {
        $this->middleware('auth:admin');

        $this->intangibleAssetStateService = $intangibleAssetStateService;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $params = $this->intangibleAssetStateService->transformParams($request->all());

            $query = $this->intangibleAssetStateRepository->search($params);

            $total = $query->count();

            $items = $this->intangibleAssetStateService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('admin.pages.intangible_assets.states.index', compact('links'))
                ->nest('filters', 'admin.pages.intangible_assets.states.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.intangible_assets.states.components.table', compact('items'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('admin.pages.intangible_assets.states.create');
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->all();

            $item = DB::transaction(function () use ($data) {
                return $this->intangibleAssetStateRepository->create($data);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.intangible_assets.states.messages.save_success', ['state' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.intangible_assets.states.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->intangibleAssetStateRepository->getById($id);

            return view('admin.pages.intangible_assets.states.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $item = $this->intangibleAssetStateRepository->getById($id);

            return view('admin.pages.intangible_assets.states.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();

            $item = $this->intangibleAssetStateRepository->getById($id);

            DB::transaction(function () use ($item, $data) {
                $this->intangibleAssetStateRepository->update($item, $data);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.intangible_assets.states.messages.update_success', ['state' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.intangible_assets.states.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = $this->intangibleAssetStateRepository->getById($id);

            DB::transaction(function () use ($item) {
                $this->intangibleAssetStateRepository->delete($item);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.intangible_assets.states.messages.delete_success', ['state' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.intangible_assets.states.messages.delete_error')]);
        }
    }
}
