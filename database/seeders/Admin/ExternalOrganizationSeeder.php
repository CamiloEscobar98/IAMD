<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\ExternalOrganizationRepository;

class ExternalOrganizationSeeder extends Seeder
{
    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    public function __construct(ExternalOrganizationRepository $externalOrganizationRepository)
    {
        $this->externalOrganizationRepository = $externalOrganizationRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->externalOrganizationRepository->createFactory(40);
    }
}
