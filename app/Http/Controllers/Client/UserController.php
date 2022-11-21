<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Client\Users\StoreRequest;
use App\Http\Requests\Client\Users\UpdateRequest;

use App\Services\Client\UserService;

use App\Repositories\Client\UserRepository;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /** @var UserService */
    protected $userService;

    /** @var UserRepository */
    protected $userRepository;

    /**
     * @param UserService $userService
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserService $userService,
        UserRepository $userRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.show')->only('show');
        $this->middleware('permission:users.store')->only(['create', 'store']);
        $this->middleware('permission:users.update')->only(['edit', 'update']);
        $this->middleware('permission:users.destroy')->only('destroy');

        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     *
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {

            $params = $this->userService->transformParams($request->all());
            $params['except_auth_user'] = true;

            $query = $this->userRepository->search($params, ['roles:id,info'], []);

            $total = $query->count();

            $items = $this->userService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.users.index')
                ->nest('filters', 'client.pages.users.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.users.components.table', compact('items', 'links'));
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
            $item = $this->userRepository->newInstance();
            return view('client.pages.users.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest
     * 
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->only('name', 'email', 'password');

            DB::beginTransaction();

            /** @var \App\Models\Client\User $item */
            $item = $this->userRepository->create($data);

            $role = $request->get('role_id');

            $item->assignRole($role);

            DB::commit();
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.users.messages.save_success', ['user' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.users.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $user
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $user)
    {
        try {
            $item = $this->userRepository->getById($user);

            return view('client.pages.users.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $user
     * 
     * @return View|RedirectResponse
     */
    public function edit($id, $user)
    {
        try {
            $item = $this->userRepository->getById($user);

            return view('client.pages.users.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  int  $id
     * 
     * @return View|RedirectResponse
     */
    public function update(UpdateRequest $request, $id, $user)
    {
        try {
            $data = [];

            $attributesRequest = is_null($request->get('password')) ? ['name', 'email', 'role_id'] : ['name', 'email', 'role_id', 'password'];

            $data = $request->only($attributesRequest);

            $item = $this->userRepository->getById($user);

            DB::beginTransaction();

            $this->userRepository->update($item, $data);

            $role = $request->get('role_id');

            /** @var \App\Models\Client\User $item */
            $item->syncRoles($role);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.users.messages.update_success', ['user' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.users.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $user
     * 
     * @return RedirectResponse
     */
    public function destroy($id, $user) #: RedirectResponse
    {
        try {
            $item = $this->userRepository->getById($user);

            DB::beginTransaction();

            $this->userRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.users.messages.delete_success')]);
        } catch (\Exception $th) {
            DB::rollBack();
            $message = '';
            switch ($th->getCode()) {
                case 23000:
                    $message = __('messages.status_code.23000');
                    break;

                default:
                    $message = __('messages.delete_error');
                    break;
            }
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $message]);
        }
    }
}
