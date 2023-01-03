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

        $this->middleware('permission:administrative_units.index')->only('index');
        $this->middleware('permission:administrative_units.show')->only('show');
        $this->middleware('permission:administrative_units.store')->only(['create', 'store']);
        $this->middleware('permission:administrative_units.update')->only(['edit', 'update']);
        $this->middleware('permission:administrative_units.destroy')->only('destroy');

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
    public function index(Request $request, $client) #: View|RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->administrativeUnitService->searchWithPagination($request->all(), $request->get('page'), [], ['research_units']);
            return view('client.pages.administrative_units.index', compact('links'))
                ->nest('filters', 'client.pages.administrative_units.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.administrative_units.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     * 
     *@param string $client
     * @return View|RedirectResponse
     */
    public function create($client): View|RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->newInstance();
            return view('client.pages.administrative_units.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.administrative_units.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        return redirect()->route('client.administrative_units.create', $client)->with('alert', $this->administrativeUnitService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param string $client
     * @param  int  $administrative_unit
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $administrative_unit, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->getById($administrative_unit);
            return view('client.pages.administrative_units.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.administrative_units.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $client
     * @param  int  $administrative_unit
     * @return View|RedirectResponse
     */
    public function edit($client, $administrative_unit, Request $request): View|RedirectResponse
    {
        try {
            $item = $this->administrativeUnitRepository->getById($administrative_unit);
            return view('client.pages.administrative_units.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.administrative_units.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $client
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $administrative_unit): RedirectResponse
    {
        return redirect()->route('client.administrative_units.edit', ['administrative_unit' => $administrative_unit, 'client' => $client])->with('alert', $this->administrativeUnitService->update($request->all(), $administrative_unit));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $client
     * @param int $administrative_unit
     * @return RedirectResponse
     */
    public function destroy($client, $administrative_unit): RedirectResponse
    {
        return redirect()->route('client.administrative_units.index', $client)->with('alert', $this->administrativeUnitService->delete($administrative_unit));
    }
}
