<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

use App\Repositories\Admin\TenantRepository;
use Exception;

class SeedTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:seed {tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecutar un Seeder en la base de datos del cliente';

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
        $this->info('Ejecuando comando: SeedTenant.');

        $tenant = strval($this->argument('tenant'));

        try {
            /** @var \App\Models\Admin\Tenant */
            $tenant = $this->tenantRepository->getByAttribute('name', $tenant);

            Config::set('database.connections.tenant', $this->tenantRepository->getArrayConfigurationDatabase($tenant));
            $tenantDatabase = Config::get('database.connections.tenant');

            isset($tenantDatabase) && $tenantDatabase ? $this->info('Tenant Database Configurated!') : $this->error('Error!');

            /** @var string */
            $command = 'db:seed';

            /** @var array<string,string> */
            $options = [
                '--database' => 'tenant',
            ];

            if ($this->confirm('¿Te gustaría ejecutar las semillas de instalación de información para la base de datos del cliente?', false)) {
                $options['--class'] = 'TenantDatabaseSeeder';
            } else {
                $seeder = $this->askModelSeeder();
            }
            Artisan::call($command, $options, $this->output);
        } catch (Exception $th) {
            $this->error($th->getMessage());
        }
    }

    private function askModelSeeder()
    {
        while (True) {
            $askModel = $this->ask("¿A qué modelo deseas ejecutar las semillas? \n 
            [1] Faculad.
            [2] Departamento Académico.
            [3] Unidad de Investigación.
            [4] Proyectos.
            [5] Activos Intangibles.
            [6] Creadores.
            [7] Usuarios.
            [8] Estrategias de Gestión.
            [9] Financión de Proyectos.
            [10] Contratación para Proyectos.
            [11] Herramientas de Priorización.
            [12] Medidas Secretas de Protección.            
            ", 0);

            if ($askModel < 1 || $askModel > 12) {
                $this->error('Error, debes de elegir una de las opciones disponibles.');
            }

            switch ($askModel) {
                case '1':
                    $this->info('HOla');
                    break;

                default:
                    # code...
                    break;
            }
        }
    }
}
