<?php

namespace Database\Seeders\Client\Creator;

use App\Repositories\Admin\ExternalOrganizationRepository;
use Illuminate\Database\Seeder;

use App\Repositories\Client\CreatorExternalRepository;
use App\Repositories\Client\CreatorInternalRepository;
use App\Repositories\Client\CreatorRepository;

use App\Repositories\Admin\LinkageTypeRepository;
use App\Repositories\Admin\AssignmentContractRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreatorInternalOrExternalSeeder extends Seeder
{
    use InteractsWithIO;

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
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!isProductionEnv()) {
            $linkageTypes = $this->linkageTypeRepository->all();
            $assignmentContracts = $this->assignmentContractRepository->all();
            $externalOrganizations = $this->externalOrganizationRepository->all();
            $creators = $this->creatorRepository->all();
            $this->command->getOutput()->progressStart($creators->count());

            foreach ($creators as $creator) {
                /** @var \App\Models\Client\Creator\Creator $creator */
                $this->info("\n-Asignando el Creador internamente o externamente: '{$creator->name}'\n");
                $randomType = (bool) rand(0, 1);
                $linkageTypeRandom = $linkageTypes->random(1)->first();
                $assignmentContractRandom = $assignmentContracts->where('is_internal', $randomType)->random(1)->first();
                $externalOrganizationRandom = $externalOrganizations->random(1)->first();

                $randomType ?
                    $this->createInternalCreator($creator, $linkageTypeRandom, $assignmentContractRandom) :
                    $this->createExternalCreator($creator, $externalOrganizationRandom, $assignmentContractRandom);
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }

    /**
     * Create an Internal Creator
     * 
     * @param \App\Models\Client\Creator\Creator $creator
     * @param \App\Models\Admin\LinkageType $linkageType
     * @param \App\Models\Admin\AssignmentContract $assignmentContract
     * 
     * @return \App\Models\Client\Creator\CreatorInternal
     */
    private function createInternalCreator($creator, $linkageType, $assignmentContract)
    {
        $this->info('Creador Interno elegido');
        $this->creatorInternalRepository->create([
            'creator_id' => $creator->id,
            'linkage_type_id' => $linkageType->id,
            'assignment_contract_id' => $assignmentContract->id
        ]);
    }

    /**
     * Create an External Creator
     * 
     * @param \App\Models\Client\Creator\Creator $creator
     * @param \App\Models\ExternalOrganization $externalOrganization
     * @param \App\Models\Admin\AssignmentContract $assignmentContract
     * 
     * @return \App\Models\Client\Creator\CreatorExternal
     */
    private function createExternalCreator($creator, $externalOrganization, $assignmentContract)
    {
        $this->info('Creador Externo elegido');
        $this->creatorExternalRepository->create([
            'creator_id' => $creator->id,
            'external_organization_id' => $externalOrganization->id,
            'assignment_contract_id' => $assignmentContract->id
        ]);
    }
}
