<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;

class IntellectualPropertyRightSeeder extends Seeder
{
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
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING INTELLECTUAL PROPERTY RIGHT  !! \n \n");

        $intellectualPropertyRightCategories = Config::get('app.intellectual_property_right_categories');

        $array = collect($intellectualPropertyRightCategories);

        foreach ($array as $category) {
            print("Creating Intellectual Property Right Category... \n");

            $categoryCreated = $this->intellectualPropertyRightCategoryRepository->create([
                'name' => $category['name']
            ]);

            print("Intellectual Property Right Category created! Name: " . $categoryCreated->name . "\n \n");

            $subcategories = collect($category['subcategories']);

            foreach ($subcategories as $subcategory) {
                print("Creating Intellectual Property Right Subcategory... \n");

                $subcategoryCreated = $this->intangibleAssetTypeLevel2Repository->create([
                    'intellectual_property_right_category_id' => $categoryCreated->id,
                    'name' => $subcategory['name']
                ]);

                print("Intellectual Property Right Subcategory created! Name " . $subcategoryCreated->name . "\n");

                $products = collect($subcategory['products']);

                foreach ($products as $product) {
                    print("Creating Intellectual Property Right Product... \n");

                    $productCreated = $this->intellectualPropertyRightProductRepository->create([
                        'intellectual_property_right_subcategory_id' => $subcategoryCreated->id,
                        'name' => $product['name'],
                        'code' => $product['code']
                    ]);

                    print("Intellectual Property Right Product created! Name " . $productCreated->name . "\n \n");
                }
            }

            print("INTELLECTUAL PROPERTY RIGHT FINISHED. \n \n");
        }
    }
}
