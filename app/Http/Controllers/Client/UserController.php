<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\UpdatePhotoRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Client\Users\StoreRequest;
use App\Http\Requests\Client\Users\UpdateRequest;

use App\Services\Client\UserService;
use App\Services\FileSystem\UserProfileImageService;

use App\Repositories\Client\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /** @var UserService */
    protected $userService;

    /** @var UserRepository */
    protected $userRepository;

    /** @var UserProfileImageService */
    protected $userProfileImageService;

    /**
     * @param UserService $userService
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserService $userService,
        UserProfileImageService $userProfileImageService,
        UserRepository $userRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.show')->only('show');
        $this->middleware('permission:users.store')->only(['create', 'store']);
        $this->middleware('permission:users.update')->only(['edit', 'update']);
        $this->middleware('permission:users.destroy')->only('destroy');

        $this->userService = $userService;
        $this->userProfileImageService = $userProfileImageService;
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
            $params = $this->userService->transformParams($request->all());
            $query = $this->userRepository->search($params, ['roles:id,info']);
            $total = $query->count();
            $items = $this->userService->customPagination($query, $params, intval($request->get('page', 1)), $total);
            $links = $items->links('pagination.customized');
            return view('client.pages.users.index', compact('links'))
                ->nest('filters', 'client.pages.users.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.users.components.table', compact('items'));
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/UserController:Index/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/UserController:Index/Exception: {$e->getMessage()}");
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
            $item = $this->userRepository->newInstance();
            return view('client.pages.users.create', compact('item'));
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/UserController:Create/Exception: {$e->getMessage()}");
        }
        return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $item = $this->userService->save($request->all());
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
            Log::info("@Web/Controllers/Client/UserController:Store/Success, Item: {$item->name}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/UserController:Store/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/UserController:Store/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.users.create', $client)->with('alert', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $client
     * @param int $user
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $user): View|RedirectResponse
    {
        try {
            $item = $this->userRepository->getById($user);
            return view('client.pages.users.show', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/UserController:Show/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/UserController:Show/Exception: {$e->getMessage()}");
        }
        return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $client
     * @param int $user
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $user): View|RedirectResponse
    {
        try {
            $item = $this->userRepository->getById($user);
            return view('client.pages.users.edit', compact('item'));
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/UserController:Edit/ModelNotFoundException: {$me->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/UserController:Edit/Exception: {$e->getMessage()}");
        }
        return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param string $client
     * @param int $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client, $user): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->userService->update($request->all(), $user);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            Log::info("@Web/Controllers/Client/UserController:Update/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/UserController:Update/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/UserController:Update/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/UserController:Update/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.users.edit', compact('client', 'user'))->with('alert', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $client
     * @param int $user
     * 
     * @return RedirectResponse
     */
    public function destroy($client, $user): RedirectResponse
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];
        try {
            $item = $this->userRepository->getById($user);
            DB::beginTransaction();
            $this->userService->delete($user);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
            Log::info("@Web/Controllers/Client/UserController:Delete/Success, Item: {$item->name}");
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/UserController:Delete/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/UserController:Delete/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/UserController:Delete/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->route('client.users.index', $client)->with('alert', $response);
    }

    /**
     * @param UpdatePhotoRequest $request
     * @param string $client
     * @param int $user
     */
    public function updateProfileImage(UpdatePhotoRequest $request, $client, $user)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            /** @var \App\Models\Client\User $user */
            $user = $this->userRepository->getById($user);

            $imageProfile = $request->file('profile_image');

            if (!is_null($imageProfile)) {
                if ($user->hasProfileImage()) {
                    $this->userProfileImageService->deleteUserProfileImage($user);
                    $this->userRepository->update($user, ['profile_image' => null]);
                }
                $fileName = time() . "-profile_user.{$imageProfile->getClientOriginalExtension()}";
                $this->userProfileImageService->storeUserProfileImage($fileName, $imageProfile);
                $this->userRepository->update($user, ['profile_image' => $fileName]);
                $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            } else {
                $this->userProfileImageService->deleteUserProfileImage($user);
                $this->userRepository->update($user, ['profile_image' => null]);
                $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            }
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/Client/UserController:updateProfileImage/ModelNotFoundException: {$me->getMessage()}");
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/UserController:updateProfileImage/QueryException: {$qe->getMessage()}");
            DB::rollBack();
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/UserController:updateProfileImage/Exception: {$e->getMessage()}");
            DB::rollBack();
        }
        return redirect()->back()->with('alert', $response);
    }
}
