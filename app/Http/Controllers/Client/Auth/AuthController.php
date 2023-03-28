<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Admin\Auth\UpdateRequest;
use App\Http\Requests\Client\Auth\UpdatePasswordRequest;

use App\Repositories\Client\UserRepository;

class AuthController extends Controller
{
    /** @var UserRepository */
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Update User information.
     * 
     * @param UpdateRequest $request
     * @param string $client
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $client): RedirectResponse
    {
        $data = $request->all();

        try {
            $item = $this->userRepository->getById(current_user()->id);

            DB::beginTransaction();

            $this->userRepository->update($item, $data);

            DB::commit();

            return redirect()->route('client.profile', $client)->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.auth.messages.update_success')]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.auth.messages.update_error')]);
        }
    }

    /**
     * Update User password.
     * 
     * @param UpdatePasswordRequest $request
     * @param string $client
     * @return RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request, $client): RedirectResponse
    {
        $data = $request->all();

        try {
            $item = $this->userRepository->getById(current_user()->id);

            DB::beginTransaction();

            $this->userRepository->update($item, $data);

            DB::commit();

            return redirect()->route('client.profile', $client)->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.auth.messages.update_password_success')]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.auth.messages.update_password_error')]);
        }
    }

    /**
     * Update User photo image.
     * 
     * @param string $client
     */
    public function updatePhoto($client)
    {
        # code...
    }
}
