<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class IntellectualPropertyRightSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intangibleAssetTypeLevel2Repository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    public function __construct(
        IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository,
        IntellectualPropertyRightSubcategoryRepository $intangibleAssetTypeLevel2Repository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository
    ) {
        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
        $this->intangibleAssetTypeLevel2Repository = $intangibleAssetTypeLevel2Repository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intellectualPropertyRightCategories = Config::get('app.intellectual_property_right_categories');

        $categories = collect($intellectualPropertyRightCategories);

        foreach ($categories as $category) {
            $this->info("\n-Creando Categoría de los Derechos de Propiedad Intelectual: '{$category['name']}'\n");
            
            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightCategory $categoryCreated */
            $categoryCreated = $this->intellectualPropertyRightCategoryRepository->create([
                'name' => $category['name']
            ]);

            $subcategories = collect($category['subcategories']);

            foreach ($subcategories as $subcategory) {
                sleep(1);
                $this->info("\n-Creando Subcategoría de los Derechos de Propiedad Intelectual: '{$subcategory['name']}'\n");

                /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory $subcategoryCreated  */
                $subcategoryCreated = $this->intangibleAssetTypeLevel2Repository->create([
                    'intellectual_property_right_category_id' => $categoryCreated->id,
                    'name' => $subcategory['name']
                ]);

                $products = collect($subcategory['products']);
                $this->command->getOutput()->progressStart($products->count());

                foreach ($products as $product) {
                    sleep(1);
                    $this->info("\n-Creando Producto de los Derechos de Propiedad Intelectual: '{$subcategory['name']}'\n");

                    $this->intellectualPropertyRightProductRepository->create([
                        'intellectual_property_right_subcategory_id' => $subcategoryCreated->id,
                        'name' => $product['name'],
                        'code' => $product['code']
                    ]);
                    $this->command->getOutput()->progressAdvance();
                }
                $this->command->getOutput()->progressFinish();
            }
        }
    }
}
