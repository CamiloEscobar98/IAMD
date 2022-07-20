<?php

return [
    'default' => [
        'create' => 'Registrar',

        'title-information' => 'Información',
    ],

    'home' => [
        'title' => 'Inicio',
    ],

    'profile' => [
        'title' => 'Perfil',
        'subtitle' => 'Perfil'
    ],

    'localizations' => [
        'title' => 'Localizaciones',
        'countries' => [
            'title' => 'Países',
            'subtitle' => 'Países',

            'titles' => [
                'create' => 'Registrar País',
                'show' => 'Visualizar País',
                'edit' => 'Editar País',
            ],

            'filters' => [
                'name' => 'Buscar País',
                'total' => 'Total de Países: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'states' => 'Departamentos',
                    'cities' => 'Ciudades',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ]
            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el país?',

                'save_success' => 'Se ha registrado correctamente el país: :country.',
                'save_error' => 'No se ha registrado el país.',

                'update_success' => 'Se ha actualizado correctamente el país: :country.',
                'update_error' => 'No se ha actualizado el país.',

                'delete_success' => 'Se ha eliminado el país: :country.',
                'delete_error' => 'No se ha eliminado el país.'
            ],

            'title-show' => 'Perfil de Visualización del País',
            'title-form' => 'Formulario de Registro de País',
            'title-update' => 'Actualización del País',

            'info-create' => "En esta sección de la aplicación podrás realizar el registro del recurso PAÍS. 
            Dicho recurso actualmente está destinado para enriquecer la información de los países dentro de la aplicación.
           \n Hay que tener en cuenta que el único país que estará nutrida de información (Departamentos y Ciudades) será el país de Colombia.",

            'info-show' => "En esta sección de la aplicación podrás visualizar el país de :country. \n
            Este país actualmente tiene una cantidad de :states_count Departamentos y :cities_count ciudades.
            "

        ]
    ]

];
