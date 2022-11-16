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
            $params = $this->externalOrganizationService->transformParams($request->all());

            $query = $this->externalOrganizationRepository->search($params);

            $total = $query->count();

            $items = $this->externalOrganizationService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('admin.pages.creators.external_organizations.index', compact('links'))
                ->nest('filters', 'admin.pages.creators.external_organizations.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.creators.external_organizations.components.table', compact('items'));
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
            $item = $this->externalOrganizationRepository->newInstance();
            return view('admin.pages.creators.external_organizations.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
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
        try {
            $data = $request->all();

            $item = DB::transaction(function () use ($data) {
                return $this->externalOrganizationRepository->create($data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.creators.external_organizations.messages.save_success', ['external_organization' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.external_organizations.messages.save_error')]);
        }
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
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
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
            return $th->getMessage();
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
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
        try {
            $data = $request->all();

            $item = $this->externalOrganizationRepository->getById($id);

            DB::transaction(function () use ($item, $data) {
                $this->externalOrganizationRepository->update($item, $data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.creators.external_organizations.messages.update_success', ['external_organization' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.external_organizations.messages.update_error')]);
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
            $item = $this->externalOrganizationRepository->getById($id);

            DB::transaction(function () use ($item) {
                $this->externalOrganizationRepository->delete($item);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.creators.external_organizations.messages.delete_success', ['external_organization' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.external_organizations.messages.delete_error')]);
        }
    }
}
