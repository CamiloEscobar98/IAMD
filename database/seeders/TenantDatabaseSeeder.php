<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Tenant\AdministrativeUnitSeeder;
use Database\Seeders\Tenant\ResearchUnit\ResearchUnitSeeder;

use Database\Seeders\Tenant\Creator\CreatorSeeder;

use Database\Seeders\Tenant\FinancingTypeSeeder;
use Database\Seeders\Tenant\ProjectContractTypeSeeder;
use Database\Seeders\Tenant\ProjectSeeder;

use Database\Seeders\Tenant\IntangibleAssetSeeder;

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

            ResearchUnitSeeder::class,

            FinancingTypeSeeder::class,
            ProjectContractTypeSeeder::class,
            ProjectSeeder::class,

            IntangibleAssetSeeder::class
        ]);
    }
}
