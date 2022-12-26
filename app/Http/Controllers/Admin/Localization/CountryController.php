<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Admin\Localizations\Countries\StoreRequest;
use App\Http\Requests\Admin\Localizations\Countries\UpdateRequest;

use App\Services\Admin\CountryService;
use App\Services\Admin\StateService;

use App\Repositories\Admin\CountryRepository;

use Exception;

class CountryController extends Controller
{
    /** @var CountryService */
    protected $countryService;

    /** @var StateService */
    protected $stateService;

    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(
        CountryService $countryService,
        StateService $stateService,

        CountryRepository $countryRepository,
    ) {
        $this->middleware('auth:admin');

        $this->countryService = $countryService;
        $this->stateService = $stateService;

        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->countryService->searchWithPagination($request->all(), $request->get('page'), [], ['states', 'cities']);
            return view('admin.pages.localization.countries.index', compact('links'))
                ->nest('filters', 'admin.pages.localization.countries.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.localization.countries.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View|RedirectResponse
    {
        $item = $this->countryRepository->newInstance();
        return view('admin.pages.localization.countries.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return redirect()->route('admin.localizations.countries.create')->with('alert', $this->countryService->save($request->only('name')));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id): View|RedirectResponse
    {
        try {
            $item = $this->countryRepository->getById($id);
            [$total, $items, $links] = $this->stateService->searchWithPagination($request->all(), $request->get('page', 1), ['cities'], ['cities'], $id);
            return view('admin.pages.localization.countries.show', compact('item', 'total', 'items', 'links'));
        } catch (Exception $th) {
            return redirect()->route('admin.localizations.countries.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.not_found')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {
            $item = $this->countryRepository->getById($id);
            return view('admin.pages.localization.countries.edit', compact('item'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.not_found')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        return redirect()->route('admin.localizations.countries.edit', $id)->with('alert', $this->countryService->update($request->only('name'), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('admin.localizations.countries.index')->with('alert', $this->countryService->delete($id));
    }
}
