<?php

namespace Database\Seeders;

use Database\Seeders\Client\AcademicDepartment\AcademicDepartmentSeeder;
use Illuminate\Database\Seeder;

use Database\Seeders\Client\AdministrativeUnit\AdministrativeUnitSeeder;

use Database\Seeders\Client\ResearchUnit\ResearchUnitCategorySeeder;
use Database\Seeders\Client\ResearchUnit\ResearchUnitSeeder;

use Database\Seeders\Client\Project\ProjectSeeder;
use Database\Seeders\Client\Project\ProjectContractTypeSeeder;

use Database\Seeders\Client\IntangibleAsset\IntangibleAssetSeeder;

use Database\Seeders\Client\Creator\CreatorSeeder;
use Database\Seeders\Client\Creator\CreatorDocumentSeeder;
use Database\Seeders\Client\Creator\CreatorInternalOrExternalSeeder;


use Database\Seeders\Client\SecretProtectionMeasure\SecretProtectionMeasureSeeder;
use Database\Seeders\Client\PriorityTool\PriorityToolSeeder;

use Database\Seeders\Client\Strategy\StrategyCategorySeeder;
use Database\Seeders\Client\Strategy\StrategySeeder;

use Database\Seeders\Client\FinancingType\FinancingTypeSeeder;

use Database\Seeders\Client\SpatieRoles\PermissionModuleSeeder;
use Database\Seeders\Client\SpatieRoles\RoleSeeder;

use Database\Seeders\Client\User\UserSeeder;

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
            CreatorDocumentSeeder::class,
            CreatorInternalOrExternalSeeder::class,

            AdministrativeUnitSeeder::class,
            AcademicDepartmentSeeder::class,

            ResearchUnitCategorySeeder::class,
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
