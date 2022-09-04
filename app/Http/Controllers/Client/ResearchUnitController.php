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

        $this->researchUnitService = $researchUnitService;
        $this->researchUnitRepository = $researchUnitRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        try {
            $params = $this->researchUnitService->transformParams($request->all());

            $query = $this->researchUnitRepository->search($params, [], ['projects']);

            $total = $query->count();

            $items = $this->researchUnitService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.research_units.index')
                ->nest('filters', 'client.pages.research_units.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.research_units.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
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
            return view('client.pages.research_units.create');
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $data = $request->all();

            DB::beginTransaction();

            $item = $this->researchUnitRepository->create($data);

            DB::commit();
            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.research_units.messages.save_success', ['research_unit' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id, $research_unit, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $item = $this->researchUnitRepository->getByIdWithRelations($research_unit, ['administrative_unit', 'research_unit_category', 'director', 'inventory_manager']);

            return view('client.pages.research_units.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $research_unit, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id, $research_unit): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        try {
            $data = $request->all();

            $item = $this->researchUnitRepository->getById($research_unit);

            DB::beginTransaction();

            $this->researchUnitRepository->update($item, $data);

            DB::commit();

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.research_units.messages.update_success', ['research_unit' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.research_units.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $research_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $research_unit)
    {
        try {
            $item = $this->researchUnitRepository->getById($research_unit);

            DB::beginTransaction();

            $this->researchUnitRepository->delete($item);

            DB::commit();

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.research_units.messages.delete_success', ['research_unit' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.research_units.messages.delete_error')]);
        }
    }
}
