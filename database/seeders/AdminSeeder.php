<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Repositories\AdminRepository;

class AdminSeeder extends Seeder
{
    /** @var AdminRepository */
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING ADMINS !! \n \n");

        $admin = $this->adminRepository->create([
            'name' => 'Patricia Ramirez',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        print("Admin Created. Name: " . $admin->name .  "\n \n");

        print("¡¡ ASSIGNMENT CONTRACTS CREATED !! \n \n");
    }
}
