<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Client\IntangibleAssets\StoreRequest;
use App\Http\Requests\Client\IntangibleAssets\UpdateRequest;

use App\Services\Client\IntangibleAssetService;

use App\Repositories\Client\IntangibleAssetRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IntangibleAssetController extends Controller
{
    /** @var IntangibleAssetService */
    protected $intangibleAssetService;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    public function __construct(
        IntangibleAssetService $intangibleAssetService,
        IntangibleAssetRepository $intangibleAssetRepository
    ) {
        $this->middleware('auth');

        $this->intangibleAssetService = $intangibleAssetService;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request) #: View|RedirectResponse
    {
        try {
            $params = $this->intangibleAssetService->transformParams($request->all());

            $query = $this->intangibleAssetRepository->search($params, ['project.research_unit.administrative_unit'], []);

            $total = $query->count();

            $items = $this->intangibleAssetService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.intangible_assets.index')
                ->nest('filters', 'client.pages.intangible_assets.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.intangible_assets.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): RedirectResponse|View
    {
        try {
            return view('client.pages.intangible_assets.create');
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();

            DB::beginTransaction();

            $item = $this->intangibleAssetRepository->create($data);

            DB::commit();
            return redirect()->back()->with('alert', [
                'title' => __('messages.success'), 'icon' => 'success',
                'text' => __('pages.client.intangible_assets.messages.save_success', ['intangible_asset' => $item->name])
            ]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse|View
     */
    public function show($id, $intangibleAsset) #: RedirectResponse|View
    {
        try {
            $item = $this->intangibleAssetRepository->getByIdWithRelations($intangibleAsset, [
                'intangible_asset_phases', 'dpis.dpi', 'intangible_asset_published', 'intangible_asset_localization',
                'intangible_asset_confidenciality_contract', 'creators', 'intangible_asset_session_right_contract', 'user_messages',
                'secret_protection_measures', 'priority_tools'
            ]);

            return view('client.pages.intangible_assets.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse|View
     */
    public function edit($id, $intangibleAsset, Request $request): RedirectResponse|View
    {
        try {
            $item = $this->intangibleAssetRepository->getById($intangibleAsset);

            return view('client.pages.intangible_assets.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id, $intangibleAsset): RedirectResponse
    {
        try {
            $data = $request->only(['project_id', 'name']);

            $item = $this->intangibleAssetRepository->getById($intangibleAsset);

            DB::beginTransaction();

            $this->intangibleAssetRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.messages.update_success', ['intangible_asset' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.messages.update_error')]);
        }
    }

    /**
     * Generate Code
     * 
     * @param int $id
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse
     */
    public function updateCode($id, $intangibleAsset) #: RedirectResponse
    {
        try {
            $item = $this->intangibleAssetRepository->getById($intangibleAsset);

            $this->intangibleAssetService->generateCodeOfIntangibleAsset($item);

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.messages.update_success', ['intangible_asset' => $item->name])]);
        } catch (\Exception $th) {
            return $th->getMessage();
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.messages.update_error')]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $intangibleAsset
     * @return View|RedirectResponse
     */
    public function destroy($id, $intangibleAsset)
    {
        try {
            $item = $this->intangibleAssetRepository->getById($intangibleAsset);

            DB::beginTransaction();

            $this->intangibleAssetRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.messages.delete_success', ['intangible_asset' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.messages.delete_error')]);
        }
    }
}
