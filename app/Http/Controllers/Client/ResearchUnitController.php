<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Client\ResearchUnits\StoreRequest;
use App\Http\Requests\Client\ResearchUnits\UpdateRequest;

use App\Services\Client\ResearchUnitService;

use App\Repositories\Client\ResearchUnitRepository;


class ResearchUnitController extends Controller
{
    /** @var ResearchUnitService */
    protected $researchUnitService;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(
        ResearchUnitService $researchUnitService,
        ResearchUnitRepository $researchUnitRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:research_units.index')->only('index');
        $this->middleware('permission:research_units.show')->only('show');
        $this->middleware('permission:research_units.store')->only(['create', 'store']);
        $this->middleware('permission:research_units.update')->only(['edit', 'update']);
        $this->middleware('permission:research_units.destroy')->only('destroy');

        $this->researchUnitService = $researchUnitService;
        $this->researchUnitRepository = $researchUnitRepository;
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param string $client     
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, $client): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->researchUnitService->searchWithPagination(
                $request->all(),
                $request->get('page'),
                ['administrative_unit', 'research_unit_category', 'director', 'inventory_manager'],
                ['projects']
            );
            return view('client.pages.research_units.index')
                ->nest('filters', 'client.pages.research_units.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.research_units.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->researchUnitRepository->newInstance();
            return view('client.pages.research_units.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $client
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, $client): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        return redirect()->route('client.research_units.create', $client)->with('alert', $this->researchUnitService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $client
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($client, $research_unit, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->researchUnitRepository->getByIdWithRelations($research_unit, ['administrative_unit', 'research_unit_category', 'director', 'inventory_manager']);
            return view('client.pages.research_units.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($client, $research_unit, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->researchUnitRepository->getById($research_unit);
            return view('client.pages.research_units.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $client, $research_unit): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        return redirect()->route('client.research_units.edit', ['research_unit' => $research_unit, 'client' => $client])->with('alert', $this->researchUnitService->update($request->all(), $research_unit));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @param int $research_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($client, $research_unit)
    {
        return redirect()->route('client.research_units.index', $client)->with('alert', $this->researchUnitService->delete($research_unit));
    }
}
