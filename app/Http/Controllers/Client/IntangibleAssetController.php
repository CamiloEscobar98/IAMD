<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Http\Requests\Client\IntangibleAssets\StoreRequest;
use App\Http\Requests\Client\IntangibleAssets\UpdateRequest;

use App\Services\Client\IntangibleAssetService;

use App\Repositories\Client\IntangibleAssetRepository;

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

        $this->middleware('permission:intangible_assets.index')->only('index');
        $this->middleware('permission:intangible_assets.show')->only('show');
        $this->middleware('permission:intangible_assets.store')->only(['create', 'store']);
        $this->middleware('permission:intangible_assets.update')->only(['edit', 'update']);
        $this->middleware('permission:intangible_assets.destroy')->only('destroy');

        $this->intangibleAssetService = $intangibleAssetService;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client) #: View|RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->intangibleAssetService->searchWithPagination($request->all(), $request->get('page'), ['intangible_asset_state', 'project.research_units']);
            return view('client.pages.intangible_assets.index', compact('links'))
                ->nest('filters', 'client.pages.intangible_assets.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.intangible_assets.components.table', compact('items'));
        } catch (\Exception $th) {
            dd($th->getMessage());
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->intangibleAssetRepository->newInstance();
            return view('client.pages.intangible_assets.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        return redirect()->route('client.intangible_assets.create', $client)->with('alert', $this->intangibleAssetService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $client
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse|View
     */
    public function show($client, $intangibleAsset) #: RedirectResponse|View
    {
        try {
            $item = $this->intangibleAssetRepository->getByIdWithRelations($intangibleAsset, [
                'intangible_asset_phases', 'dpis.dpi', 'intangible_asset_published', 'intangible_asset_localization',
                'intangible_asset_confidenciality_contract', 'creators', 'intangible_asset_session_right_contract', 'user_messages',
                'secret_protection_measures:id,name', 'priority_tools', 'research_units:id,name'
            ]);
            return view('client.pages.intangible_assets.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.intangible_assets.index')
                ->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse|View
     */
    public function edit($client, $intangibleAsset, Request $request)#: RedirectResponse|View
    {
        try {
            $item = $this->intangibleAssetRepository->getByIdWithRelations($intangibleAsset, ['research_units:id,name']);
            return view('client.pages.intangible_assets.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.intangible_assets.index')
                ->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $client
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $intangibleAsset): RedirectResponse
    {
        return redirect()->route('client.intangible_assets.edit', ['intangible_asset' => $intangibleAsset, 'client' => $client])->with('alert', $this->intangibleAssetService->update($request->all(), $intangibleAsset));
    }

    /**
     * Generate Code
     * 
     * @param int $client
     * @param int $intangibleAsset
     * 
     * @return RedirectResponse
     */
    public function updateCode($client, $intangibleAsset) #: RedirectResponse
    {
        return redirect()->route('client.intangible_assets.show', ['intangible_asset' => $intangibleAsset, 'client' => $client])->with('alert', $this->intangibleAssetService->updateCode($intangibleAsset));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @param int $intangibleAsset
     * @return View|RedirectResponse
     */
    public function destroy($client, $intangibleAsset)
    {
        return redirect()->route('client.intangible_assets.index', $client)->with('alert', $this->intangibleAssetService->delete($intangibleAsset));
    }
}
