<?php

namespace App\Http\ViewComposers\Client\Permissions;

use App\Repositories\Client\PermissionModuleRepository;
use Illuminate\View\View;

class CreatePermissionComposer
{
    /** @var PermissionModuleRepository */
    protected $permissionModuleRepository;

    public function __construct(
        PermissionModuleRepository $permissionModuleRepository
    ) {
        $this->permissionModuleRepository = $permissionModuleRepository;
    }

    public function compose(View $view)
    {
        $modules = $this->permissionModuleRepository->all()->pluck('name', 'id')->prepend('---Seleccionar Módulo');

        $view->with(compact('modules'));
    }
}
