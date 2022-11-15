<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Services\Client\RoleService;
use App\Repositories\Client\RoleRepository;

class RoleController extends Controller
{
    /** @var RoleRepository */
    protected $roleRepository;

    /** @var RoleService */
    protected $roleService;

    public function __construct(
        RoleService $roleService,
        RoleRepository $roleRepository
    ) {
        $this->roleService = $roleService;

        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {

            $params = $this->roleService->transformParams($request->all());

            $query = $this->roleRepository->search($params, [], ['users', 'permissions']);

            $total = $query->count();

            $items = $this->roleService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.roles.index')
                ->nest('filters', 'client.pages.roles.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.roles.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create()
    {
        try {
            $item = $this->roleRepository->newInstance();
            return view('client.pages.roles.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return View|RedirectResponse
     */
    public function store(Request $request): View|RedirectResponse
    {
        try {
            return view();
        } catch (\Exception $th) {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function show($id): View|RedirectResponse
    {
        try {
            return view();
        } catch (\Exception $th) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id): View|RedirectResponse
    {
        try {
            return view();
        } catch (\Exception $th) {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function update(Request $request, $id): View|RedirectResponse
    {
        try {
            return view();
        } catch (\Exception $th) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function destroy($id): View|RedirectResponse
    {
        try {
            return view();
        } catch (\Exception $th) {
            return redirect()->back();
        }
    }
}
