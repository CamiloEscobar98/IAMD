<?php

namespace App\Http\ViewComposers\Client\Roles;

use App\Repositories\Client\PermissionRepository;
use App\Repositories\Client\PermissionModuleRepository;
use Illuminate\View\View;

class ShowRoleComposer
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
        $permissionModules = $this->permissionModuleRepository->search([], ['permissions:id,permission_module_id,info'])->get();

        $view->with(compact('permissionModules'));
    }
}
