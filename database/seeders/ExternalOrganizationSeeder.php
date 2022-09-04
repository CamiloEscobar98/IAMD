<?php

namespace Database\Seeders;

use App\Repositories\Admin\ExternalOrganizationRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
