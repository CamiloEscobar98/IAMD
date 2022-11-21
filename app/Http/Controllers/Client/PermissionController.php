<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Http\Request;
use App\Http\Requests\Client\Permissions\StoreRequest;
use App\Http\Requests\Client\Permissions\UpdateRequest;

use App\Services\Client\PermissionService;

use App\Repositories\Client\PermissionRepository;

class PermissionController extends Controller
{
    /** @var PermissionService */
    protected $permissionService;

    /** @var PermissionRepository */
    protected $permissionRepository;

    public function __construct(
        PermissionService $permissionService,
        PermissionRepository $permissionRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:permissions.index')->only('index');
        $this->middleware('permission:permissions.show')->only('show');
        $this->middleware('permission:permissions.store')->only(['create', 'store']);
        $this->middleware('permission:permissions.update')->only(['edit', 'update']);
        $this->middleware('permission:permissions.destroy')->only('destroy');

        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $params = $this->permissionService->transformParams($request->all());

            $query = $this->permissionRepository->search($params, ['permission_module:id,name'], []);

            $total = $query->count();

            $items = $this->permissionService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.permissions.index')
                ->nest('filters', 'client.pages.permissions.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.permissions.components.table', compact('items', 'links'));
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
            $item = $this->permissionRepository->newInstance();
            return view('client.pages.permissions.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * 
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->permissionRepository->create($data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.permissions.messages.save_success', ['permission' => $item->info])]);
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
            $item = $this->permissionRepository->getById($role);

            return view('client.pages.permissions.show', compact('item'));
        } catch (\Exception $th) {
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
            $item = $this->permissionRepository->getById($role);

            return view('client.pages.permissions.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest  $request
     * @param  int  $id
     * @param int $role
     * @return View|RedirectResponse
     */
    public function update(UpdateRequest $request, $id, $role): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->permissionRepository->getById($role);

            $this->permissionRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.permissions.messages.update_success', ['permission' => $item->info])]);
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
     * @return View|RedirectResponse
     */
    public function destroy($id, $role): RedirectResponse
    {
        try {
            $item = $this->permissionRepository->getById($role);

            DB::beginTransaction();

            $this->permissionRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.permissions.messages.delete_success', ['permission' => $item->info])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
