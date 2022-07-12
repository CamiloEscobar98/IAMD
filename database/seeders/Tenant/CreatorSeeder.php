<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

use App\Repositories\Tenant\CreatorRepository;

class CreatorSeeder extends Seeder
{
    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(CreatorRepository $creatorRepository)
    {
        $this->creatorRepository = $creatorRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->creatorRepository->createFactory(20);
    }
}
