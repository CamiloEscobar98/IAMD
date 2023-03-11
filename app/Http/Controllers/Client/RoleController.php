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
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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
            $params = $this->roleService->transformParams($request->all());
            $query = $this->roleRepository->search($params, [], ['users', 'permissions']);
            $total = $query->count();
            $items = $this->roleService->customPagination($query, $params, $request->get('page'), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.roles.index')
                ->nest('filters', 'client.pages.roles.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.roles.components.table', compact('items', 'links'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/RoleController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/RoleController:Index/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            $item = $this->roleRepository->newInstance();
            return view('client.pages.roles.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/RoleController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->roleService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/RoleController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/RoleController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/RoleController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.roles.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $client
     * @param int $role
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $role): View|RedirectResponse
    {
        try {
            $item = $this->roleRepository->search(['id' => $role], ['permissions'])->get()->first();
            return view('client.pages.roles.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/RoleController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/RoleController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.roles.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $client
     * @param int $role
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $role): View|RedirectResponse
    {
        try {
            $item = $this->roleRepository->getById($role);
            return view('client.pages.roles.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/RoleController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/RoleController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.roles.show', ['role' => $role, 'client' => $client])->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  string  $client
     * @param int $role
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $role): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->roleService->update($request->all(), $role);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/RoleController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/RoleController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/RoleController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/RoleController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.roles.edit', compact('client', 'role'))->with('alert', $response);
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
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->roleRepository->getById($role);
            DB::beginTransaction();
            $this->roleService->delete($role);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/RoleController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/RoleController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/RoleController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/RoleController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.roles.index', $client)->with('alert', $response);
    }
}
