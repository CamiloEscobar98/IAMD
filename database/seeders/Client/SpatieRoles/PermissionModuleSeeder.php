<?php

namespace Database\Seeders\Client\SpatieRoles;

use Illuminate\Database\Seeder;

use App\Repositories\Client\PermissionModuleRepository;
use App\Repositories\Client\PermissionRepository;

class PermissionModuleSeeder extends Seeder
{
    /** @var PermissionModuleRepository */
    protected $permissionModuleRepository;

    /** @var PermissionRepository */
    protected $permissionRepository;

    public function __construct(
        PermissionModuleRepository $permissionModuleRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->permissionModuleRepository = $permissionModuleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionModules = config('permission.seeders.permission_modules');

        print("¡¡ CREATING PERMISSION MODULES !! \n \n");

        foreach ($permissionModules as $key => $permissionModuleItem) {
            $cont = $key++;
            print("Creating Permission Module: {$cont}. \n");
            $permissionModule = $this->permissionModuleRepository->create(['name' => $permissionModuleItem['name']]);
            print("Permission Module Created. Name: " . $permissionModule->name .  "\n \n");

            /** Permissions */
            $permissions = $permissionModuleItem['permissions'];

            foreach ($permissions as $key2 => $permissionItem) {
                $cont2 = $key2++;
                $permissionItem['permission_module_id'] = $permissionModule->id;

                print("Creating Permission: {$cont2}. \n");
                $permission = $this->permissionRepository->create($permissionItem);
                print("Permission Created. Name: " . $permission->name .  "\n \n");
            }
        }

        print("¡¡ PERMISSION MODULES CREATED !! \n \n");
    }
}
