<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\IntangibleAssetStateRepository;

class IntangibleAssetStateSeeder extends Seeder
{
    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    public function __construct(IntangibleAssetStateRepository $intangibleAssetStateRepository)
    {
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $array = [
            [
                'name' => 'No Identificado',
                'description' => 'Si el activo intangible no se había detectado, caracterizado o identificado como activo intangible hasta la fecha.',
            ],

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

        print("¡¡ CREATING ASSIGNMENT CONTRACTS !! \n \n");

        $cont = 0;

        foreach ($array as $item) {

            $current = $cont + 1;
            print("Creating Intangible Asset State: $current. \n");
            $state = $this->intangibleAssetStateRepository->create($item);
            print("Intangible Asset State Created. Name: " . $state->name .  "\n \n");

            $cont++;
        }

        print("¡¡ INTANGIBLE ASSET STATE CREATED !! \n \n");
    }
}
