<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Admin\AdminSeeder;

use Database\Seeders\Admin\TenantSeeder;
use Database\Seeders\Admin\DocumentTypeSeeder;
use Database\Seeders\Admin\ExternalOrganizationSeeder;

use Database\Seeders\Localization\CountrySeeder;
use Database\Seeders\Localization\StateAndCitySeeder;

use Database\Seeders\Admin\AssignmentContractSeeder;
use Database\Seeders\Admin\LinkageTypeSeeder;

use Database\Seeders\Admin\IntangibleAssetTypeLevels;
use Database\Seeders\Admin\IntangibleAssetStateSeeder;

use Database\Seeders\Admin\NotificationTypeSeeder;

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
            AdminSeeder::class,

            TenantSeeder::class,
            DocumentTypeSeeder::class,
            ExternalOrganizationSeeder::class,

            CountrySeeder::class,
            StateAndCitySeeder::class,

            AssignmentContractSeeder::class,
            LinkageTypeSeeder::class,

            IntangibleAssetTypeLevels::class,
            IntangibleAssetStateSeeder::class,

            NotificationTypeSeeder::class
        ]);
    }
}
