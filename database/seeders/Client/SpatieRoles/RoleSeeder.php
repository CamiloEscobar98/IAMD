<?php

namespace Database\Seeders\Client\SpatieRoles;

use App\Repositories\Client\PermissionRepository;
use Illuminate\Database\Seeder;

use App\Repositories\Client\RoleRepository;

class RoleSeeder extends Seeder
{
    /** @var RoleRepository */
    protected $roleRepository;

    /** @var PermissionRepository */
    protected $permissionRepository;

    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('permission.seeders.roles');

        print("¡¡ CREATING ROLES FOR USERS !! \n \n");

        foreach ($roles as $key => $role) {
            print("Creating Role: {++$key}. \n");
            $role = $this->roleRepository->create($role);
            print("Role Created. Name: " . $role->name .  "\n \n");
        }

        print("¡¡ ROLES CREATED !! \n \n");

        $permissions = $this->permissionRepository->all();

        /** @var \App\Models\Client\Role $employeeRole */
        $employeeRole = $this->roleRepository->getByAttribute('name', 'employee');

        /** @var \App\Models\Client\Role $adminRole */
        $adminRole = $this->roleRepository->getByAttribute('name', 'admin');

        $adminRole->syncPermissions($permissions);

        $employeeRole->syncPermissions($permissions);
    }
}
