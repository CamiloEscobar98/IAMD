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
        ini_set('memory_limit', '512M');

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
                $seeder = 'TenantDatabaseSeeder';
            } else {
                $seeder = $this->askModelSeeder();
            }
            $options['--class'] = $seeder;
            Artisan::call($command, $options, $this->output);
        } catch (Exception $th) {
            $this->error($th->getMessage());
        }
    }

    private function askModelSeeder(): string
    {
        while (True) {
            $seederPath = 'Database\Seeders\Client';
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
            [10] Herramientas de Priorización.
            [11] Medidas Secretas de Protección.            
            ", 0);

            if ($askModel < 1 || $askModel > 12) {
                $this->error('Error, debes de elegir una de las opciones disponibles.');
            }

            switch ($askModel) {
                case '1':
                    $seeder = $this->ask('Escribe el seeder para las facultades.');
                    $seederPath = $seederPath . "\AdministrativeUnit\\{$seeder}";
                    break;
                case '2':
                    $seeder = $this->ask('Escribe el seeder para los departamentos académicos.');
                    $seederPath = $seederPath . "\AcademicDepartment\\{$seeder}";
                    break;
                case '3':
                    $seeder = $this->ask('Escribe el seeder para las Unidades de Investigación.');
                    $seederPath = $seederPath . "\ResearchUnit\\{$seeder}";
                    break;
                case '4':
                    $seeder = $this->ask('Escribe el seeder para los Proyectos.');
                    $seederPath = $seederPath . "\Project\\{$seeder}";
                    break;
                case '5':
                    $seeder = $this->ask('Escribe el seeder para los Activos Intangibles.');
                    $seederPath = $seederPath . "\IntangibleAsset\\{$seeder}";
                    break;
                case '6':
                    $seeder = $this->ask('Escribe el seeder para los Creadores.');
                    $seederPath = $seederPath . "\Creator\\{$seeder}";
                    break;
                case '7':
                    $seeder = $this->ask('Escribe el seeder para los Usuarios.');
                    $seederPath = $seederPath . "\User\\{$seeder}";
                    break;
                case '8':
                    $seeder = $this->ask('Escribe el seeder para las Estrategias de Gestión.');
                    $seederPath = $seederPath . "\Strategy\\{$seeder}";
                    break;
                case '9':
                    $seeder = $this->ask('Escribe el seeder para las Financiaciones de Proyectos.');
                    $seederPath = $seederPath . "\FinancingType\\{$seeder}";
                    break;
                case '10':
                    $seeder = $this->ask('Escribe el seeder para las Herramientas de Priorización.');
                    $seederPath = $seederPath . "\PriorityTool\\{$seeder}";
                    break;
                case '11':
                    $seeder = $this->ask('Escribe el seeder para las Medidas Secretas de Protección.');
                    $seederPath = $seederPath . "\SecretProtectionMeasure\\{$seeder}";
                    break;
            }

            return $seederPath;
        }
    }
}
