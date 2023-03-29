<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Repositories\Admin\AdminRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class AdminSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var AdminRepository */
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->info("-Creando el administrador principal de la aplicación\n");
        $this->command->getOutput()->progressStart(1);
        sleep(1);
        /** @var \App\Models\Admin $admin */
        $admin = $this->adminRepository->create([
            'name' => 'Usuario Administrador',
            'email' => 'admin@gmail.com',
            'password' => 'password'
        ]);
        $this->command->getOutput()->progressAdvance();
        $this->command->getOutput()->progressFinish();
        $this->info("-El Administrador: '{$admin->name}' ha sido creado exitosamente");
    }
}
