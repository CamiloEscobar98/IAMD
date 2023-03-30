<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\TenantRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class TenantSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var TenantRepository */
    protected $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->output = new ConsoleOutput();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenantsArray = [
            [
                'name' => 'ufps',
                'info' => 'Universidad Francisco de Paula Santander',

                'url' => null,
                'host' => 'mysql',

                'database' => 'ufps',
                'username' => 'root',
                'password' => '',
            ],
            [
                'name' => 'ufpso',
                'info' => 'Universidad Francisco de Paula Santander Ocaña',

                'url' => null,
                'host' => 'mysql',

                'database' => 'ufpso',
                'username' => 'root',
                'password' => '',
            ]
        ];

        $this->command->getOutput()->progressStart(count($tenantsArray));
        foreach ($tenantsArray as $tenantItem) {
            $this->info("\n-Creando configuración para el cliente: '{$tenantItem['info']}'\n");
            sleep(1);
            $this->tenantRepository->create($tenantItem);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
