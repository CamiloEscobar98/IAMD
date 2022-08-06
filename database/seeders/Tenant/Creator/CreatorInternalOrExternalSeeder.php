<?php

namespace Database\Seeders\Tenant\Creator;

use App\Repositories\ExternalOrganizationRepository;
use Illuminate\Database\Seeder;

use App\Repositories\Tenant\CreatorExternalRepository;
use App\Repositories\Tenant\CreatorInternalRepository;
use App\Repositories\Tenant\CreatorRepository;

use App\Repositories\LinkageTypeRepository;
use App\Repositories\AssignmentContractRepository;

class CreatorInternalOrExternalSeeder extends Seeder
{
    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var CreatorInternalRepository */
    protected $creatorInternalRepository;

    /** @var CreatorExternalRepository */
    protected $creatorExternalRepository;

    /** @var LinkageTypeRepository */
    protected $linkageTypeRepository;

    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    public function __construct(
        CreatorRepository $creatorRepository,
        CreatorInternalRepository $creatorInternalRepository,
        CreatorExternalRepository $creatorExternalRepository,

        LinkageTypeRepository $linkageTypeRepository,
        AssignmentContractRepository $assignmentContractRepository,
        ExternalOrganizationRepository $externalOrganizationRepository
    ) {
        $this->creatorRepository = $creatorRepository;
        $this->creatorInternalRepository = $creatorInternalRepository;
        $this->creatorExternalRepository = $creatorExternalRepository;

        $this->linkageTypeRepository = $linkageTypeRepository;
        $this->assignmentContractRepository = $assignmentContractRepository;
        $this->externalOrganizationRepository = $externalOrganizationRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING INTERNAL OR EXTERNAL CREATORS !! \n \n");

        $linkageTypes = $this->linkageTypeRepository->all();
        $assignmentContracts = $this->assignmentContractRepository->all();
        $externalOrganizations = $this->externalOrganizationRepository->all();

        $creators = $this->creatorRepository->all();

        $totalCreators = $creators->count();

        print("Creating for $totalCreators creators. \n \n");

        $creators->each(function ($creator) use ($linkageTypes, $assignmentContracts, $externalOrganizations) {
            $randomType = (bool) rand(0, 1);
            
            $linkageType = $linkageTypes->random(1)->first();
            $assignmentContract = $assignmentContracts->where('is_internal', $randomType)->random(1)->first();
            $externalOrganization = $externalOrganizations->random(1)->first();

            $randomType ?
                $this->createInternalCreator($creator, $linkageType, $assignmentContract) :
                $this->createExternalCreator($creator, $externalOrganization, $assignmentContract);
        });

        print("¡¡ INTERNAL OR EXTERNAL CREATORS CREATED !! \n \n");
    }

    /**
     * Create an Internal Creator
     * 
     * @param \App\Models\Tenant\Creator $creator
     * @param \App\Models\LinkageType $linkageType
     * @param \App\Models\AssignmentContract $assignmentContract
     * 
     * @return \App\Models\Tenant\CreatorInternal
     */
    private function createInternalCreator($creator, $linkageType, $assignmentContract)
    {
        print("INTERNAL CREATOR choosed! \n \n");

        $this->creatorInternalRepository->create([
            'creator_id' => $creator->id,
            'linkage_type_id' => $linkageType->id,
            'assignment_contract_id' => $assignmentContract->id
        ]);

        print("INTERNAL CREATOR created! \n \n");
    }

    /**
     * Create an External Creator
     * 
     * @param \App\Models\Tenant\Creator $creator
     * @param \App\Models\ExternalOrganization $externalOrganization
     * @param \App\Models\AssignmentContract $assignmentContract
     * 
     * @return \App\Models\Tenant\CreatorExternal
     */
    private function createExternalCreator($creator, $externalOrganization, $assignmentContract)
    {
        print("EXTERNAL CREATOR choosed! \n \n");

        $this->creatorExternalRepository->create([
            'creator_id' => $creator->id,
            'external_organization_id' => $externalOrganization->id,
            'assignment_contract_id' => $assignmentContract->id
        ]);

        print("EXTERNAL CREATOR created! \n \n");
    }
}
