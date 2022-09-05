<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\Admin\Auth\UpdateRequest;
use App\Http\Requests\Admin\Auth\UpdatePasswordRequest;

use App\Repositories\Admin\AdminRepository;

class HomeController extends Controller
{
    /** @var AdminRepository */
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->middleware('auth:admin');

        $this->adminRepository = $adminRepository;
    }

    public function profile()
    {
        return view('admin.pages.auth.profile');
    }

    public function update(UpdateRequest $request)
    {
        try {

            $data = $request->all();

            DB::transaction(function () use ($data) {
                $admin = $this->adminRepository->getAuthUser();
                $this->adminRepository->update($admin, $data);
            });

            return back()->with('alert', ['title' => '¡Éxito!', 'icon' => 'success', 'text' => 'Se ha actualizado tu información correctamente.']);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => '¡Error!', 'icon' => 'error', 'text' => 'No se pudo actualizar tu información.']);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {

            $data = $request->all();

            DB::transaction(function () use ($data) {
                $admin = $this->adminRepository->getAuthUser();
                $this->adminRepository->update($admin, $data);
            });

            return back()->with('alert', ['title' => '¡Éxito!', 'icon' => 'success', 'text' => 'Se ha actualizado tu contraseña correctamente.']);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => '¡Error!', 'icon' => 'error', 'text' => 'NO se pudo actualizar tu contraseña.']);
        }
    }

    public function home()
    {
        return view('admin.pages.home');
    }
}
