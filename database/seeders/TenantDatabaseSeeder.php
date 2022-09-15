<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Client\AdministrativeUnitSeeder;
use Database\Seeders\Client\ResearchUnit\ResearchUnitSeeder;

use Database\Seeders\Client\Creator\CreatorSeeder;

use Database\Seeders\Client\FinancingTypeSeeder;
use Database\Seeders\Client\ProjectContractTypeSeeder;
use Database\Seeders\Client\ProjectSeeder;

use Database\Seeders\Client\IntangibleAssetSeeder;

use Database\Seeders\Client\UserSeeder;

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
            UserSeeder::class,

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
