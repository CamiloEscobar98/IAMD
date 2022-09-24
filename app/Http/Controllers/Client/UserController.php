<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


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

            $query = $this->userRepository->search($params, [], []);

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
            return view('client.pages.users.create');
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            //code...
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function show($id)
    {
        try {
            //code...
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id)
    {
        try {
            //code...
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            //code...
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function destroy($id)
    {
        try {
            //code...
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
