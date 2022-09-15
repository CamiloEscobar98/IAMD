<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Repositories\Admin\AdminRepository;

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
            'password' => Hash::make('password')
        ]);

        print("Admin Created. Name: " . $admin->name .  "\n \n");

        print("¡¡ ASSIGNMENT CONTRACTS CREATED !! \n \n");
    }
}
