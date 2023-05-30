<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Mail\SendPasswordReset;

use App\Http\Requests\Client\Auth\UpdateRequest;
use App\Http\Requests\Client\Auth\UpdatePasswordRequest;
use App\Http\Requests\Client\Auth\SendResetPasswordMailRequest;
use App\Repositories\Client\RoleRepository;
use Exception;

use App\Repositories\Client\UserRepository;

class AuthController extends Controller
{

    public function __construct(
        protected UserRepository $userRepository,
        protected RoleRepository $roleRepository
    ) {
        $this->middleware('guest:web')->only('sendResetPasswordMail');
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

            return redirect()->route('client.profile', $client)->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.profile.messages.update_success')]);
        } catch (Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.profile.messages.update_error')]);
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

            return redirect()->route('client.profile', $client)->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.profile.messages.update_password_success')]);
        } catch (Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.profile.messages.update_password_error')]);
        }
    }

    public function sendResetPasswordMail(SendResetPasswordMailRequest $request, $client)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.send_email-error')];
        try {
            $user = $this->userRepository->getByAttribute('email', $request->get('email'));
            $newPassword = $this->userRepository->resetPassword($user);
            Mail::to($user->email)->send(new SendPasswordReset($user, $newPassword));
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.send_email-success')];
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/Auth/LoginController:sendResetPasswordMail/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.reset_password', $client)->with('alert', $response);
    }

    /** 
     * Change the role in session.
     * 
     * @param Request $request
     * @param string $client
     */
    public function changeRoleInSession(Request $request, $client)
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            $role = $this->roleRepository->getById($request->role_id);
            if (current_user()->hasRole($role)) {
                session(['current_role' => $role]);
                $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            }
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/Auth/LoginController:sendResetPasswordMail/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.home', $client)->with('alert', $response);
    }
}
