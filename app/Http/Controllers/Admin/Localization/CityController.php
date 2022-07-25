<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\Localizations\Cities\StoreRequest;
use App\Http\Requests\Admin\Localizations\Cities\UpdateRequest;

use App\Services\Localization\CityService;

use App\Repositories\CityRepository;
use App\Repositories\StateRepository;

class CityController extends Controller
{
    /** @var CityService  */
    protected $cityService;

    /** @var CityRepository  */
    protected $cityRepository;

    /** @var StateRepository  */
    protected $stateRepository;

    public function __construct(
        CityService $cityService,

        CityRepository $cityRepository,
        StateRepository $stateRepository
    ) {
        $this->middleware('auth:admin');

        $this->cityService = $cityService;

        $this->cityRepository = $cityRepository;
        $this->stateRepository = $stateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $oldParams = $request->all();

            $params = $this->cityService->transformParams($request->all());

            $query = $this->cityRepository->search($params, ['country', 'state']);

            $total = $query->count();
            $items = $this->cityService->customPagination($query, $params, null, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            $states = $this->stateRepository->search([], ['country'])->get();

            $params = $oldParams;

            return view('admin.pages.localization.cities.index', compact('links'))
                ->nest('filters', 'admin.pages.localization.cities.components.filters', compact('params', 'total', 'states'))
                ->nest('table', 'admin.pages.localization.cities.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $states = $this->stateRepository->search([], ['country'])->get();

            return view('admin.pages.localization.cities.create', compact('states'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $item = DB::transaction(function () use ($data) {
                return $this->cityRepository->create($data);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.localizations.cities.messages.save_success', ['city' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.localizations.cities.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->cityRepository->search(['id' => $id], ['country', 'state'])->get()->first();

            return view('admin.pages.localization.cities.show', compact('item'));
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
            $states = $this->stateRepository->search([], ['country'])->get();

            $item = $this->cityRepository->search(['id' => $id], ['country', 'state'])->get()->first();

            return view('admin.pages.localization.cities.edit', compact('item', 'states'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        try {
            $data = $request->all();
            $item = $this->cityRepository->getById($id);

            DB::transaction(function () use ($data, $item) {
                $this->cityRepository->update($item, $data);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.localizations.cities.messages.update_success', ['city' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.localizations.cities.messages.update_error')]);
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
            $item = $this->cityRepository->getById($id);

            DB::transaction(function () use ($item) {
                $this->cityRepository->delete($item);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.localizations.cities.messages.delete_success', ['city' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.localizations.cities.messages.delete_error')]);
        }
    }
}
