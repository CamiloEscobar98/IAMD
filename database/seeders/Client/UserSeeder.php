<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use App\Repositories\Client\UserRepository;

class UserSeeder extends Seeder
{
    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userRepository->createOneFactory([
            'email' => 'client@gmail.com',
        ]);

        print("¡¡ CREATING USERS !! \n \n");

        $randomNumber = rand(50, 100);

        $cont = 0;
        do {
            $current = $cont + 1;

            print("Creating User: $current. \n");

            /** @var \App\Models\Client\User $user */
            $user = $this->userRepository->createOneFactory();
            print("User Created. Name: " . $user->name . "\n \n");

            $user->assignRole('employee');

            $cont++;
            $randomNumber--;
        } while ($randomNumber > 0);

        print("USERS FINISHED. \n \n");
    }
}
