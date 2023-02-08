<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\FinancingTypes\StoreRequest;
use App\Http\Requests\Client\FinancingTypes\UpdateRequest;

use App\Services\Client\FinancingTypeService;

use App\Repositories\Client\FinancingTypeRepository;

class FinancingTypeController extends Controller
{
    /** @var FinancingTypeService */
    protected $financingTypeService;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    public function __construct(
        FinancingTypeService $financingTypeService,
        FinancingTypeRepository $financingTypeRepository
    ) {
        $this->middleware('auth');

        $this->financingTypeService = $financingTypeService;
        $this->financingTypeRepository = $financingTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param string $client
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->financingTypeService->searchWithPagination($request->all(), $request->get('page'));
            return view('client.pages.financing_types.index')
                ->nest('filters', 'client.pages.financing_types.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.financing_types.components.table', compact('items', 'links'));
        } catch (\Exception $e) {
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $client
     * @return View|RedirectResponse
     */
    public function create($client): View|RedirectResponse
    {
        try {
            $item = $this->financingTypeRepository->newInstance();
            return view('client.pages.financing_types.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.financing_types.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        return redirect()->route('client.financing_types.create', $client)->with('alert', $this->financingTypeService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $financingType): View|RedirectResponse
    {
        try {
            $item = $this->financingTypeRepository->getById($financingType);

            return view('client.pages.financing_types.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.financing_types.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $financingType): View|RedirectResponse
    {
        try {
            $item = $this->financingTypeRepository->getById($financingType);
            return view('client.pages.financing_types.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.financing_types.show', ['financing_type' => $financingType, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int $client
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $client, $financingType): RedirectResponse
    {
        return redirect()->route('client.financing_types.edit', ['financing_type' => $financingType, 'client' => $client])
            ->with('alert', $this->financingTypeService->update($request->all(), $financingType));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function destroy($client, $financingType): RedirectResponse
    {
        return redirect()->route('client.financing_types.index', $client)->with('alert', $this->financingTypeService->delete($financingType));
    }
}
