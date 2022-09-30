<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Client\AdministrativeUnits\StoreRequest;
use App\Http\Requests\Client\AdministrativeUnits\UpdateRequest;

use App\Services\Client\AdministrativeUnitService;

use App\Repositories\Client\AdministrativeUnitRepository;

class AdministrativeUnitController extends Controller
{
    /** @var AdministrativeUnitService */
    protected $administrativeUnitService;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    public function __construct(
        AdministrativeUnitService $administrativeUnitService,
        AdministrativeUnitRepository $administrativeUnitRepository
    ) {

        $this->middleware('auth');

        $this->administrativeUnitService = $administrativeUnitService;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $params = $this->administrativeUnitService->transformParams($request->all());

            $query = $this->administrativeUnitRepository->search($params, [], ['research_units']);

            $total = $query->count();

            $items = $this->administrativeUnitService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.administrative_units.index')
                ->nest('filters', 'client.pages.administrative_units.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.administrative_units.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            return view('client.pages.administrative_units.create');
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();

            $item = DB::transaction(function () use ($data) {
                return $this->administrativeUnitRepository->create($data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.administrative_units.messages.save_success', ['administrative_unit' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.administrative_units.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $administrative_unit
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $administrative_unit, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->getById($administrative_unit);


            return view('client.pages.administrative_units.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $request->client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id, $administrative_unit, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->getById($administrative_unit);


            return view('client.pages.administrative_units.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $request->client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id, $administrative_unit): RedirectResponse
    {
        try {
            $data = $request->all();

            $item = $this->administrativeUnitRepository->getById($administrative_unit);

            DB::transaction(function () use ($data, $item) {
                return $this->administrativeUnitRepository->update($item, $data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.administrative_units.messages.update_success', ['administrative_unit' => $item->name])]);
        } catch (\Exception $th) {
            dd($th->getMessage());
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.administrative_units.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id, $administrative_unit): RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->getById($administrative_unit);

            DB::beginTransaction();

            $this->administrativeUnitRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.administrative_units.messages.delete_success', ['country' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.administrative_units.messages.delete_error')]);
        }
    }
}
