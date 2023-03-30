<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

use App\Repositories\Admin\TenantRepository;
use Exception;

class MigrateFreshTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrate {tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate a Tenant database.';

    /** @var TenantRepository */
    protected $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        parent::__construct();

        $this->tenantRepository = $tenantRepository;
    }

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle()
    {
        $this->info('Command TenantMigrateFresh.');

        $tenant = strval($this->argument('tenant'));

        try {
            /** @var \App\Models\Admin\Tenant */
            $tenant = $this->tenantRepository->getByAttribute('name', $tenant);

            Config::set('database.connections.tenant', $this->tenantRepository->getArrayConfigurationDatabase($tenant));
            $tenantDatabase = Config::get('database.connections.tenant');

            isset($tenantDatabase) && $tenantDatabase ? $this->info('Tenant Database Configurated!') : $this->error('Error!');

            /** @var string */
            $command = 'migrate';

            /** @var array<string,string> */
            $options = [
                '--path' => 'database/migrations/tenant',
                '--database' => 'tenant',
            ];

            if ($this->confirm('¿Te gustaría resetear la base de datos del cliente?', false)) {
                $command = 'migrate:fresh';
                if ($this->confirm('¿Te gustaría ejecutar las semillas de instalación de información para la base de datos del cliente?', false)) {
                    $options['--seeder'] = 'TenantDatabaseSeeder';
                }
            } else {
                $command = 'migrate';
            }
            Artisan::call($command, $options, $this->output);
        } catch (Exception $th) {
            $this->error($th->getMessage());
        }
    }
}
