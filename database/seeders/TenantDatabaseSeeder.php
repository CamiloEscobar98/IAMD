<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Tenant\AdministrativeUnitSeeder;
use Database\Seeders\Tenant\CreatorSeeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdministrativeUnitSeeder::class,
            CreatorSeeder::class,
        ]);
    }
}
