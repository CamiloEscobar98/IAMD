<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Services\Localization\StateService;
use App\Services\Localization\CityService;

use App\Repositories\CountryRepository;
use App\Repositories\StateRepository;
use App\Repositories\CityRepository;

class StateController extends Controller
{
    /** @var StateService */
    protected $stateService;

    /** @var CityService */
    protected $cityService;

    /** @var StateRepository */
    protected $stateRepository;

    /** @var CountryRepository */
    protected $countryRepository;

    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        StateService $stateService,
        CityService $cityService,

        CountryRepository $countryRepository,
        StateRepository $stateRepository,
        CityRepository $cityRepository
    ) {
        $this->middleware('auth:admin');

        $this->stateService = $stateService;
        $this->cityService = $cityService;

        $this->stateRepository = $stateRepository;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $params = $this->stateService->transformParams($request->all());

            $query = $this->stateRepository->search($params, ['cities'], ['cities']);

            $total = $query->count();
            $items = $this->stateService->customPagination($query, $params, null, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            $countries = $this->countryRepository->all();

            return view('admin.pages.localization.states.index', compact('links'))
                ->nest('filters', 'admin.pages.localization.states.components.filters', compact('params', 'total', 'countries'))
                ->nest('table', 'admin.pages.localization.states.components.table', compact('items'));
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $item = $this->stateRepository->getById($id);

            $params = $this->cityService->transformParams($request->all());

            $query = $this->cityRepository->search($params, [], [], $id);
            $total = $query->count();
            $states = $this->cityService->customPagination($query, $params, 10, $request->get('page'), $total);
            $links = $states->links('pagination.customized');

            return view('admin.pages.localization.states.show', compact('item', 'total', 'states', 'links'));
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->stateRepository->getById($id);

            return view('admin.pages.localization.states.edit', compact('item'));
        } catch (\Exception $th) {
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            $item = $this->stateRepository->getById($id);

            DB::transaction(function () use ($item) {
                $this->stateRepository->delete($item);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.localizations.states.messages.delete_success', ['country' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.localizations.states.messages.delete_error')]);
        }
    }
}
