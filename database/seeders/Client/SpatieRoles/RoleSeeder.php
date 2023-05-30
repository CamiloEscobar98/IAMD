<?php

namespace Database\Seeders\Client\SpatieRoles;

use App\Repositories\Client\PermissionRepository;
use Illuminate\Database\Seeder;

use App\Repositories\Client\RoleRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class RoleSeeder extends Seeder
{
    use InteractsWithIO;

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
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('permission.seeders.roles');

        $this->info('Creando los roles del sistema');

        $this->command->getOutput()->progressStart(count($roles));

        foreach ($roles as $role) {
            $this->info("\n-Creando el rol del sistema: '{$role['name']}'\n");
            $role = $this->roleRepository->create($role);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();

        $permissions = $this->permissionRepository->all();

        /** @var \App\Models\Client\Role $employeeRole */
        $employeeRole = $this->roleRepository->getByAttribute('name', 'employee');

        /** @var \App\Models\Client\Role $adminRole */
        $adminRole = $this->roleRepository->getByAttribute('name', 'admin');

        $adminRole->syncPermissions($permissions);
    }
}
