<?php

namespace App\Http\ViewComposers\Admin;

use App\Repositories\Admin\AssignmentContractRepository;
use App\Repositories\Admin\CityRepository;
use Illuminate\View\View;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\DocumentTypeRepository;
use App\Repositories\Admin\ExternalOrganizationRepository;
use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use App\Repositories\Admin\StateRepository;

class DashboardComposer
{
    /** @var CountryRepository */
    protected $countryRepository;

    /** @var StateRepository */
    protected $stateRepository;

    /** @var CityRepository */
    protected $cityRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    public function __construct(
        CountryRepository $countryRepository,
        StateRepository $stateRepository,
        CityRepository $cityRepository,

        DocumentTypeRepository $documentTypeRepository,
        ExternalOrganizationRepository $externalOrganizationRepository,
        AssignmentContractRepository $assignmentContractRepository,

        IntangibleAssetStateRepository $intangibleAssetStateRepository,

        IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository

    ) {
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
        $this->cityRepository = $cityRepository;

        $this->documentTypeRepository = $documentTypeRepository;
        $this->externalOrganizationRepository = $externalOrganizationRepository;
        $this->assignmentContractRepository = $assignmentContractRepository;
        
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        
        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
    }

    public function compose(View $view)
    {
        $countryCount = $this->countryRepository->all()->count();
        $stateCount = $this->stateRepository->all()->count();
        $cityCount = $this->cityRepository->all()->count();

        $documentTypeCount = $this->documentTypeRepository->all()->count();
        $externalOrganizationCount = $this->externalOrganizationRepository->all()->count();
        $assignmentContractCount = $this->assignmentContractRepository->all()->count();

        $intangibleAssetStateCount = $this->intangibleAssetStateRepository->all()->count();

        $categoryCount = $this->intellectualPropertyRightCategoryRepository->all()->count();
        $subcategoryCount = $this->intellectualPropertyRightSubcategoryRepository->all()->count();
        $productCount = $this->intellectualPropertyRightProductRepository->all()->count();

        $view->with(compact(
            'countryCount',
            'stateCount',
            'cityCount',

            'documentTypeCount',
            'externalOrganizationCount',
            'assignmentContractCount',

            'intangibleAssetStateCount',

            'categoryCount',
            'subcategoryCount',
            'productCount',
        ));
    }
}
