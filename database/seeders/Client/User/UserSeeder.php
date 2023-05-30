<?php

namespace Database\Seeders\Client\User;

use Illuminate\Database\Seeder;

use App\Repositories\Client\UserRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUserAdmin();
        if (!isProductionEnv()) {
            $usersNum = (int)$this->command->ask("¿Cuántos Usuarios desea crear para el ambiente de desarrollo? \nPor defecto se crearán 5 usuarios.", 5);
            $usersNum = !is_numeric($usersNum) || $usersNum <= 0 ? 5 : $usersNum;
            $users = \App\Models\Client\User::factory()->count($usersNum)->make();

            $this->command->getOutput()->progressStart(count($users));
            foreach ($users as $user) {
                $this->info("\n-Creando Usuario: '{$user->name}'\n");
                $user->save();
                $user->assignRole('employee');
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        }
    }

    /**
     * Create a new user admin
     */
    protected function createUserAdmin()
    {
        $this->info('Creando usuario administrador con todos los permisos registrados de la aplicación. Correo Electrónico: cliente@gmail.com Contraseña: password1234');
        $user = $this->userRepository->createOneFactory([
            'email' => 'cliente@gmail.com',
        ]);
        $user->assignRole('admin');
    }
}
