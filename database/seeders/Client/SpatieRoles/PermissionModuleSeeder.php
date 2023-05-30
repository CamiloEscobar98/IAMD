<?php

namespace Database\Seeders\Client\SpatieRoles;

use Illuminate\Database\Seeder;

use App\Repositories\Client\PermissionModuleRepository;
use App\Repositories\Client\PermissionRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class PermissionModuleSeeder extends Seeder
{
    use InteractsWithIO;

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
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionModules = config('permission.seeders.permission_modules');

        $this->info('Creando los módulos y permisos de la aplicación cliente');

        foreach ($permissionModules as $permissionModuleItem) {
            sleep(1);
            $this->info("\n-Creando el módulo: '{$permissionModuleItem['name']}'\n");

            /** @var \App\Models\Client\PermissionModule $permissionModule */
            $permissionModule = $this->permissionModuleRepository->create(['name' => $permissionModuleItem['name']]);

            /** Permissions */
            $permissions = $permissionModuleItem['permissions'];
            $this->command->getOutput()->progressStart(count($permissions));

            foreach ($permissions as $permissionItem) {
                $permissionItem['permission_module_id'] = $permissionModule->id;

                $this->permissionRepository->create($permissionItem);
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        }
    }
}
