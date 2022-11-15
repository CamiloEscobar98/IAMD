<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Localizations\Countries\StoreRequest;
use App\Http\Requests\Admin\Localizations\Countries\UpdateRequest;

use App\Services\Admin\CountryService;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;
use App\Services\Admin\StateService;

class CountryController extends Controller
{
    /** @var CountryService */
    protected $countryService;

    /** @var CountryRepository */
    protected $countryRepository;

    /** @var StateService */
    protected $stateService;

    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(
        CountryService $countryService,
        StateService $stateService,

        CountryRepository $countryRepository,
        StateRepository $stateRepository
    ) {
        $this->middleware('auth:admin');

        $this->countryService = $countryService;
        $this->stateService = $stateService;

        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $params = $this->countryService->transformParams($request->all());

            $query = $this->countryRepository->search($params, [], ['states', 'cities']);

            $total = $query->count();
            $items = $this->countryService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

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
    public function create()
    {
        try {
            $item = $this->countryRepository->newInstance();
            return view('admin.pages.localization.countries.create', compact('item'));
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
                return $this->countryRepository->create($data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.countries.messages.save_success', ['country' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.save_error')]);
        }
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
            $item = $this->countryRepository->getById($id);

            $params = $this->stateService->transformParams($request->all());

            $query = $this->stateRepository->search($params, ['cities'], ['cities'], $id);
            $total = $query->count();
            $states = $this->stateService->customPagination($query, $params, 10, $request->get('page'), $total);
            $links = $states->links('pagination.customized');

            return view('admin.pages.localization.countries.show', compact('item', 'total', 'states', 'links'));
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
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

            $item = $this->countryRepository->getById($id);

            DB::transaction(function () use ($item, $data) {
                $this->countryRepository->update($item, $data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.countries.messages.update_success', ['country' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.update_error')]);
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
            $item = $this->countryRepository->getById($id);

            DB::transaction(function () use ($item) {
                $this->countryRepository->delete($item);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.countries.messages.delete_success', ['country' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.delete_error')]);
        }
    }
}
