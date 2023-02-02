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
     * @param string $client
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->userService->searchWithPagination($request->all(), $request->get('page'), ['roles:id,info'], []);
            return view('client.pages.users.index', compact('links'))
                ->nest('filters', 'client.pages.users.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.users.components.table', compact('items'));
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
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        return redirect()->route('client.users.create', $client)->with('alert', $this->userService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $client
     * @param int $user
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $user)
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
     * @param  string  $client
     * @param int $user
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $user)
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
     * @param string $client
     * @return View|RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $user)
    {
        return redirect()->route('client.users.edit', ['user' => $user, 'client' => $client])
            ->with('alert', $this->userService->update($request->all(), $user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $client
     * @param int $user
     * 
     * @return RedirectResponse
     */
    public function destroy($client, $user) #: RedirectResponse
    {
        return redirect()->route('client.users.index', $client)->with('alert', $this->userService->delete($user));
    }
}
