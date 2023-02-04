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
     * @param Request $request
     * @param string $client
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $client)
    {
        try {
            [$params, $total, $items, $links] = $this->permissionService->searchWithPagination($request->all(), $request->get('page'), ['permission_module:id,name'], []);
            return view('client.pages.permissions.index')
                ->nest('filters', 'client.pages.permissions.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.permissions.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        return redirect()->route('client.permissions.create', $client)->with('alert', $this->permissionService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  string $client
     * @param int $permission
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $permission)
    {
        try {
            $item = $this->permissionRepository->getById($permission);
            return view('client.pages.permissions.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.permissions.index', $client)
                ->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $client
     * @param int $permission
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $permission)
    {
        try {
            $item = $this->permissionRepository->getById($permission);
            return view('client.pages.permissions.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.permissions.show', ['permission' => $permission, 'client' => $client])
                ->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest  $request
     * @param  string $client
     * @param int $permission
     * @return View|RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $permission): RedirectResponse
    {
        return redirect()->route('client.permissions.edit', ['permission' => $permission, 'client' => $client])
            ->with('alert', $this->permissionService->update($request->all(), $permission));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $client
     * @param int $permission
     * 
     * @return View|RedirectResponse
     */
    public function destroy($client, $permission): RedirectResponse
    {
        return redirect()->route('client.permissions.index', $client)->with('alert', $this->permissionService->delete($permission));
    }
}
