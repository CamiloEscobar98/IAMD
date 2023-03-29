<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class IntangibleAssetStateSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    public function __construct(IntangibleAssetStateRepository $intangibleAssetStateRepository)
    {
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $intangibleAssetStates = [

            [
                'name' => 'Identificado y No Protegido',
                'description' => 'Si el activo intangible se había detectado, caracterizado o identificado pero no se han protegido los derechos de propiedad intelectual asociados al mismo.',
            ],

            [
                'name' => 'Identificado y Protegido',
                'description' => 'Si se ha detectado, caracterizado o identificado y se han protegido los derechos de propiedad intelectual asociados al mismo.',
            ],

            [
                'name' => 'Identificado y en Proceso de Protección',
                'description' => 'Si se ha detectado, caracterizado o identificado y  se ha iniciado el proceso de protección de los derechos de propiedad intelectual asociados al mismo, 
                pero dicho proceso de protección no ha finalizado.',
            ],

            [
                'name' => 'Identificado y Solicitud de Protección Negada',
                'description' => 'Si se ha detectado, caracterizado o identificado y se solicitó proteger los derechos de propiedad intelectual asociados al mismo, 
                pero dicha solicitud de protección fue negada.',
            ],
        ];

        $this->command->getOutput()->progressStart(count($intangibleAssetStates));

        foreach ($intangibleAssetStates as $state) {
            $this->info("\n-Creando Estado para los Activos Intangibles: '{$state['name']}'\n");
            sleep(1);
            $this->intangibleAssetStateRepository->create($state);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
