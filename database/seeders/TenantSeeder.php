<?php

namespace Database\Seeders;

use App\Repositories\TenantRepository;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /** @var TenantRepository */
    protected $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Creating UFPS database */
        $this->tenantRepository->create([
            'name' => 'ufps',
            'url' => null,
            'host' => 'mysql',

            'database' => 'ufps',
            'username' => 'root',
            'password' => 'password',
        ]);

        /** Creating UFPSO database */
        $this->tenantRepository->create([
            'name' => 'ufpso',
            'url' => null,
            'host' => 'mysql',

            'database' => 'ufpso',
            'username' => 'root',
            'password' => 'password',
        ]);
    }
}
