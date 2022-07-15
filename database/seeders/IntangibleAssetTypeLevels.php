<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Repositories\IntangibleAssetTypeLevel1Repository;
use App\Repositories\IntangibleAssetTypeLevel2Repository;
use App\Repositories\IntangibleAssetTypeLevel3Repository;
use Illuminate\Support\Facades\Config;

class IntangibleAssetTypeLevels extends Seeder
{
    /** @var IntangibleAssetTypeLevel1Repository */
    protected $intangibleAssetTypeLevel1Repository;

    /** @var IntangibleAssetTypeLevel2Repository */
    protected $intangibleAssetTypeLevel2Repository;

    /** @var IntangibleAssetTypeLevel3Repository */
    protected $intangibleAssetTypeLevel3Repository;

    public function __construct(
        IntangibleAssetTypeLevel1Repository $intangibleAssetTypeLevel1Repository,
        IntangibleAssetTypeLevel2Repository $intangibleAssetTypeLevel2Repository,
        IntangibleAssetTypeLevel3Repository $intangibleAssetTypeLevel3Repository
    ) {
        $this->intangibleAssetTypeLevel1Repository = $intangibleAssetTypeLevel1Repository;
        $this->intangibleAssetTypeLevel2Repository = $intangibleAssetTypeLevel2Repository;
        $this->intangibleAssetTypeLevel3Repository = $intangibleAssetTypeLevel3Repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING INTANGIBLE ASSET TYPE LEVEL 1  !! \n \n");

        $intangibleAssetTypeLevels = Config::get('app.intangibleAssetCategoryLevels');

        $array = collect($intangibleAssetTypeLevels);

        foreach ($array as $item) {
            print("Creating Level 1... \n");

            $level1 = $this->intangibleAssetTypeLevel1Repository->create([
                'name' => $item['name']
            ]);

            print("Level 1 created! Name: " . $level1->name . "\n \n");

            $levels2 = collect($item['level2']);

            foreach ($levels2 as $item2) {
                print("Creating Level 2... \n");

                $level2 = $this->intangibleAssetTypeLevel2Repository->create([
                    'intangible_asset_type_level1_id' => $level1->id,
                    'name' => $item2['name']
                ]);

                print("Level 2 created! Name " . $level2->name . "\n");

                $levels3 = collect($item2['level3']);

                foreach ($levels3 as $value) {
                    print("Creating Level 3... \n");

                    $level3 = $this->intangibleAssetTypeLevel3Repository->create([
                        'intangible_asset_type_level2_id' => $level2->id,
                        'name' => $value
                    ]);

                    print("Level 3 created! Name " . $level3->name . "\n \n");
                }
            }

            print("INTANGIBLE ASSET LEVEL FINISHED. \n \n");
        }
    }
}
