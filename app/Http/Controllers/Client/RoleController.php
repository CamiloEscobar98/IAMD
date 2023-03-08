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
     * @param Request $request
     * @param string $client
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {

        try {
            [$params, $total, $items, $links] = $this->roleService->searchWithPagination($request->all(), $request->get('page'), [], ['users', 'permissions']);
            return view('client.pages.roles.index')
                ->nest('filters', 'client.pages.roles.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.roles.components.table', compact('items', 'links'));
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
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        return redirect()->route('client.roles.create', $client)->with('alert', $this->roleService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $client
     * @param int $role
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $role)
    {
        try {
            $item = $this->roleRepository->search(['id' => $role], ['permissions'])->get()->first();
            return view('client.pages.roles.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.roles.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $client
     * @param int $role
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $role)
    {
        try {
            $item = $this->roleRepository->getById($role);
            return view('client.pages.roles.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.roles.show', ['role' => $role, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  string  $client
     * @param int $role
     * @return View|RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $role): RedirectResponse
    {
        return redirect()->route('client.roles.edit', ['role' => $role, 'client' => $client])
            ->with('alert', $this->roleService->update($request->all(), $role));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $client
     * @param int $role
     * 
     * @return RedirectResponse
     */
    public function destroy($client, $role): RedirectResponse
    {
        return redirect()->route('client.roles.index', $client)->with('alert', $this->roleService->delete($role));
        
    }
}
