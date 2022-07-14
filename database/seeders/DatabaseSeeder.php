<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Localization\CountrySeeder;
use Database\Seeders\Localization\StateAndCitySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TenantSeeder::class,
            DocumentTypeSeeder::class,
            ExternalOrganizationSeeder::class,

            CountrySeeder::class,
            StateAndCitySeeder::class,

            AssignmentContractSeeder::class,
            LinkageTypeSeeder::class,

            IntangibleAssetTypeLevels::class,
        ]);
    }
}
