<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\Roles\StoreRequest;
use App\Http\Requests\Client\Roles\UpdateRequest;

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
        $this->middleware('auth');

        $this->middleware('permission:roles.index')->only('index');
        $this->middleware('permission:roles.show')->only('show');
        $this->middleware('permission:roles.store')->only(['create', 'store']);
        $this->middleware('permission:roles.update')->only(['edit', 'update']);
        $this->middleware('permission:roles.destroy')->only('destroy');

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
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
     * @param  StoreRequest $request
     * 
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            /** @var \App\Models\Client\Role $item */
            $item = $this->roleRepository->create($data);

            $permissions = $request->get('permissions');

            $item->syncPermissions($permissions);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.roles.messages.save_success', ['role' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $role
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $role)
    {
        try {
            $params['id'] = $role;

            $item = $this->roleRepository->search($params, ['permissions'])->get()->first();

            return view('client.pages.roles.show', compact('item'));
        } catch (\Exception $th) {
            dd($th);
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $role
     * 
     * @return View|RedirectResponse
     */
    public function edit($id, $role)
    {
        try {
            $item = $this->roleRepository->getById($role);

            return view('client.pages.roles.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    $request
     * @param  int  $id
     * @param int $role
     * @return View|RedirectResponse
     */
    public function update(UpdateRequest $request, $id, $role): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->roleRepository->getById($role);

            $this->roleRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.roles.messages.update_success', ['role' => $item->info])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $role
     * 
     * @return RedirectResponse
     */
    public function destroy($id, $role): RedirectResponse
    {
        try {
            $item = $this->roleRepository->getById($role);

            DB::beginTransaction();

            $this->roleRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.roles.messages.delete_success', ['strategy' => $item->info])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the permissions of role.
     * 
     * @param int $id
     * @param int $role
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePermissions($id, $role, Request $request)
    {
        try {
            /** @var \App\Models\Client\Role $item */
            $item = $this->roleRepository->getById($role);

            $permissions = $request->get('permissions');

            $item->syncPermissions($permissions);

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.roles.messages.update_success', ['role' => $item->info])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
