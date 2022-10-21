<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Client\UserSeeder;

use Database\Seeders\Client\AdministrativeUnitSeeder;
use Database\Seeders\Client\ResearchUnit\ResearchUnitSeeder;

use Database\Seeders\Client\Creator\CreatorSeeder;

use Database\Seeders\Client\SecretProtectionMeasureSeeder;
use Database\Seeders\Client\PriorityToolSeeder;

use Database\Seeders\Client\StrategyCategorySeeder;
use Database\Seeders\Client\StrategySeeder;

use Database\Seeders\Client\FinancingTypeSeeder;
use Database\Seeders\Client\ProjectContractTypeSeeder;
use Database\Seeders\Client\ProjectSeeder;

use Database\Seeders\Client\IntangibleAssetSeeder;
use Database\Seeders\Client\SpatieRoles\PermissionModuleSeeder;
use Database\Seeders\Client\SpatieRoles\RoleSeeder;

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
            PermissionModuleSeeder::class,

            RoleSeeder::class,

            UserSeeder::class,

            CreatorSeeder::class,
            AdministrativeUnitSeeder::class,

            ResearchUnitSeeder::class,

            SecretProtectionMeasureSeeder::class,
            PriorityToolSeeder::class,

            StrategyCategorySeeder::class,
            StrategySeeder::class,

            FinancingTypeSeeder::class,
            ProjectContractTypeSeeder::class,
            ProjectSeeder::class,

            IntangibleAssetSeeder::class
        ]);
    }
}
