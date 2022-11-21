<?php

namespace App\Http\ViewComposers\Client\Users;

use App\Repositories\Client\RoleRepository;
use Illuminate\View\View;

class UserFormComposer
{
    /** @var RoleRepository */
    protected $roleRepository;

    public function __construct(
        RoleRepository $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function compose(View $view)
    {
        $roles = $this->roleRepository->all()->pluck('info', 'id')->prepend('---Seleccionar un Rol del Sistema', -1);

        $view->with(compact('roles'));
    }
}
