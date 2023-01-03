<?php

namespace App\Http\Controllers\Admin\Creator;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Creator\ExternalOrganizations\StoreRequest;
use App\Http\Requests\Admin\Creator\ExternalOrganizations\UpdateRequest;

use App\Repositories\Admin\ExternalOrganizationRepository;

use App\Services\Admin\ExternalOrganizationService;

class ExternalOrganizationController extends Controller
{
    /** @var ExternalOrganizationService */
    protected $externalOrganizationService;

    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    public function __construct(
        ExternalOrganizationService $externalOrganizationService,
        ExternalOrganizationRepository $externalOrganizationRepository
    ) {
        $this->middleware('auth:admin');
        $this->externalOrganizationService = $externalOrganizationService;
        $this->externalOrganizationRepository = $externalOrganizationRepository;
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

            [$params, $total, $items, $links] = $this->externalOrganizationService->searchWithPagination($request->all(), $request->get('page'));
            return view('admin.pages.creators.external_organizations.index', compact('links'))
                ->nest('filters', 'admin.pages.creators.external_organizations.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.creators.external_organizations.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.creators.external_organizations.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->externalOrganizationRepository->newInstance();
            return view('admin.pages.creators.external_organizations.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return redirect()->route('admin.creators.external_organizations.create')->with('alert', $this->externalOrganizationService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->externalOrganizationRepository->getById($id);
            return view('admin.pages.creators.external_organizations.show', compact('item'));
        } catch (\Exception $th) {
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
            $item = $this->externalOrganizationRepository->getById($id);
            return view('admin.pages.creators.external_organizations.edit', compact('item'));
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
    public function update(UpdateRequest $request, $id)
    {
        return redirect()->route('admin.creators.external_organizations.edit', $id)->with('alert', $this->externalOrganizationService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('admin.creators.external_organizations.index')->with('alert', $this->externalOrganizationService->delete($id));
    }
}
