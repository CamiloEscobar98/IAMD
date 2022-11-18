<?php

namespace App\Http\ViewComposers\Client\Permissions;

use App\Repositories\Client\PermissionModuleRepository;
use Illuminate\View\View;

class FilterPermissionComposer
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
        $modules = $this->permissionModuleRepository->all()->pluck('name', 'id');

        $view->with(compact('modules'));
    }
}
