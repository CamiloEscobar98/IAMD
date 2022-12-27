<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\Localizations\Cities\StoreRequest;
use App\Http\Requests\Admin\Localizations\Cities\UpdateRequest;

use App\Services\Admin\CityService;

use App\Repositories\Admin\CityRepository;

class CityController extends Controller
{
    /** @var CityService  */
    protected $cityService;

    /** @var CityRepository  */
    protected $cityRepository;

    public function __construct(
        CityService $cityService,

        CityRepository $cityRepository,
    ) {
        $this->middleware('auth:admin');

        $this->cityService = $cityService;

        $this->cityRepository = $cityRepository;
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

            [$params, $total, $items, $links] = $this->cityService->searchWithPagination($request->all(), $request->get('page'), ['country', 'state']);
            return view('admin.pages.localization.cities.index', compact('links'))
                ->nest('filters', 'admin.pages.localization.cities.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.localization.cities.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.localizations.cities.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->cityRepository->newInstance();
            return view('admin.pages.localization.cities.create', compact('item'));
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
    public function store(StoreRequest $request)
    {
        return redirect()->route('admin.localizations.cities.create')->with('alert', $this->cityService->save($request->all()));
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
            $item = $this->cityRepository->getById($id);
            return view('admin.pages.localization.cities.show', compact('item'));
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.cities.messages.not_found')]);
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
            $item = $this->cityRepository->search(['id' => $id], ['country', 'state'])->get()->first();
            return view('admin.pages.localization.cities.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.cities.messages.not_found')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        return redirect()->route('admin.localizations.cities.edit', $id)->with('alert', $this->cityService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('admin.localizations.cities.index')->with('alert', $this->cityService->delete($id));
    }
}
