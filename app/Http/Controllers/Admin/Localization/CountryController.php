<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Services\Localization\CountryService;

use App\Repositories\CountryRepository;

class CountryController extends Controller
{
    /** @var CountryService */
    protected $countryService;

    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(
        CountryService $countryService,

        CountryRepository $countryRepository
    ) {
        $this->middleware('auth:admin');

        $this->countryService = $countryService;

        $this->countryRepository = $countryRepository;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
