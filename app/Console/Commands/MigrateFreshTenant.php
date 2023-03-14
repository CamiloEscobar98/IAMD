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
            $this->warn('Searching Tenant...');

            /** @var \App\Models\Admin\Tenant */
            $tenant = $this->tenantRepository->getByAttribute('name', $tenant);
            $this->info('Tenant searched.');

            $this->warn('Creating configuration for Tenant Database...');
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

            if ($this->confirm('Would you like to refresh the tenants database?', false)) {
                $command = 'migrate:fresh';
                if ($this->confirm('Would you like seeding the tenants database?', false)) {
                    $options['--seeder'] = 'TenantDatabaseSeeder';
                }
            } else {
                $command = 'migrate';
            }
            while (Artisan::call($command, $options)) {
                print(Artisan::output());
            }
        } catch (Exception $th) {
            $this->error($th->getMessage());
        }
    }
}
