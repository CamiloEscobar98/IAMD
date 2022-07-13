<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Tenant\AdministrativeUnitSeeder;
use Database\Seeders\Tenant\CreatorSeeder;
use Database\Seeders\Tenant\ResearchUnitCategorySeeder;
use Database\Seeders\Tenant\ResearchUnitSeeder;
use Database\Seeders\Tenant\FinancingTypeSeeder;
use Database\Seeders\Tenant\ProjectContractTypeSeeder;
use Database\Seeders\Tenant\ProjectSeeder;

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

            ResearchUnitCategorySeeder::class,
            ResearchUnitSeeder::class,

            FinancingTypeSeeder::class,
            ProjectContractTypeSeeder::class,
            ProjectSeeder::class
        ]);
    }
}
