<?php

return [
    'default' => [
        'create' => 'Registrar',

        'title-information' => 'Información',

        'empty_table' => 'Actualmente no existen registros.'
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
                ],

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
            ",

            'states' => [
                'title' => 'Lista de Departamentos',
            ]
        ],

        'states' => [
            'title' => 'Departamentos',
            'subtitle' => 'Departamentos',

            'titles' => [
                'create' => 'Registrar Departamento',
                'show' => 'Visualizar Departamento',
                'edit' => 'Editar Departamento',
            ],

            'filters' => [
                'name' => 'Buscar Departamento',
                'total' => 'Total de Departamentos: ',

                'country' => 'País',
                'country_option' => 'Buscar por País',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'country' => 'País',
                    'cities' => 'Ciudades',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el departamento?',

                'save_success' => 'Se ha registrado correctamente el departamento: :state.',
                'save_error' => 'No se ha registrado el departamento.',

                'update_success' => 'Se ha actualizado correctamente el departamento: :state.',
                'update_error' => 'No se ha actualizado el departamento.',

                'delete_success' => 'Se ha eliminado el departamento: :state.',
                'delete_error' => 'No se ha eliminado el departamento.'
            ],

            'title-show' => 'Perfil de Visualización del Departamento',
            'title-form' => 'Formulario de Registro de Departamento',
            'title-update' => 'Actualización del Departamento',

            'info-create' => "En esta sección de la aplicación podrás realizar el registro del recurso DEPARTAMENTO. 
            Dicho recurso actualmente está destinado para enriquecer la información de los departamentos dentro de la aplicación. ",

            'info-show' => "En esta sección de la aplicación podrás visualizar el departamento de :state. \n
            Este departamento actualmente tiene una cantidad de :cities_count ciudades.
            ",

            'cities' => [
                'title' => 'Lista de Ciudades',
            ]
        ],

        'cities' => [
            'title' => 'Ciudades',
            'subtitle' => 'Ciudades',

            'titles' => [
                'create' => 'Registrar Ciudad',
                'show' => 'Visualizar Ciudad',
                'edit' => 'Editar Ciudad',
            ],

            'filters' => [
                'name' => 'Buscar Ciudad',
                'total' => 'Total de Ciudades: ',

                'state' => 'Departamento',
                'state_option' => 'Buscar por Departamento',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'country' => 'País',
                    'state' => 'Departamento',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar la ciudad?',

                'save_success' => 'Se ha registrado correctamente la ciudad: :city.',
                'save_error' => 'No se ha registrado la ciudad.',

                'update_success' => 'Se ha actualizado correctamente la ciudad: :city.',
                'update_error' => 'No se ha actualizado la ciudad.',

                'delete_success' => 'Se ha eliminado la ciudad: :city.',
                'delete_error' => 'No se ha eliminado la ciudad.'
            ],

            'title-show' => 'Perfil de Visualización del Ciudad',
            'title-form' => 'Formulario de Registro de Ciudad',
            'title-update' => 'Actualización del Ciudad',

            'info-create' => "En esta sección de la aplicación podrás realizar el registro del recurso CIUDAD. 
                Dicho recurso actualmente está destinado para enriquecer la información de las ciudades dentro de la aplicación. ",

            'info-show' => "En esta sección de la aplicación podrás visualizar la ciudad de :city.",
        ]
    ],

    'creators' => [
        'title' => 'Información Adicional para Creadores',
        'document_types' => [
            'title' => 'Tipos de Documento',
            'subtitle' => 'Tipos de Documento',

            'titles' => [
                'create' => 'Registrar Tipo de Documento',
                'show' => 'Visualizar Tipo de Documento',
                'edit' => 'Editar Tipo de Documento',
            ],

            'filters' => [
                'name' => 'Buscar Tipo de Documento',
                'total' => 'Total de Tipos de Documento: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el Tipo de Documento?',

                'save_success' => 'Se ha registrado correctamente el Tipo de Documento: :document_type.',
                'save_error' => 'No se ha registrado el Tipo de Documento.',

                'update_success' => 'Se ha actualizado correctamente el Tipo de Documento: :document_type.',
                'update_error' => 'No se ha actualizado el Tipo de Documento.',

                'delete_success' => 'Se ha eliminado el Tipo de Documento: :document_type.',
                'delete_error' => 'No se ha eliminado el Tipo de Documento.'
            ],

            'title-show' => 'Perfil de Visualización del Tipo de Documento',
            'title-form' => 'Formulario de Registro de Tipo de Documento',
            'title-update' => 'Actualización del Tipo de Documento',

            'info-create' => "En esta sección de la aplicación podrás realizar el registro del recurso TIPO DE DOCUMENTO. 
            Dicho recurso actualmente está destinado para enriquecer la información de los tipos de documentos dentro de la aplicación. ",

            'info-show' => "En esta sección de la aplicación podrás visualizar el tipo de documento de :document_type.",
        ],
        'external_organizations' => [
            'title' => 'Organizaciones Externas',
            'subtitle' => 'Organizaciones Externas',

            'titles' => [
                'create' => 'Registrar Organización Externa',
                'show' => 'Visualizar Organización Externa',
                'edit' => 'Editar Organización Externa',
            ],

            'filters' => [
                'name' => 'Buscar Organización Externa',
                'nit' => 'Buscar por NIT',
                'total' => 'Total de Organizaciones Externas: ',
            ],

            'table' => [
                'head' => [
                    'nit' => 'Identificación',
                    'name' => 'Empresa',
                    'email' => 'Correo Corporativo',
                    'telephone' => 'Teléfono',
                    'address' => 'Residencia',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar la Organización Externa?',

                'save_success' => 'Se ha registrado correctamente la Organización Externa: :external_organization.',
                'save_error' => 'No se ha registrado la Organización Externa.',

                'update_success' => 'Se ha actualizado correctamente la Organización Externa: :external_organization.',
                'update_error' => 'No se ha actualizado la Organización Externa.',

                'delete_success' => 'Se ha eliminado la Organización Externa: :external_organization.',
                'delete_error' => 'No se ha eliminado la Organización Externa.'
            ],

            'title-show' => 'Perfil de Visualización de la Organización Externa',
            'title-form' => 'Formulario de Registro de Organización Externa',
            'title-update' => 'Actualización de la Organización Externa',

            'info-create' => "En esta sección de la aplicación podrás realizar el registro del recurso ORGANIZACIÓN EXTERNA. 
            Dicho recurso actualmente está destinado para enriquecer la información de las organizaciones externas dentro de la aplicación. ",

            'info-show' => "En esta sección de la aplicación podrás visualizar la organización externa de :external_organization.",
        ],
        'assignment_contracts' => [
            'title' => 'Tipos de Contrato',
            'subtitle' => 'Tipos de Contrato',

            'titles' => [
                'create' => 'Registrar Tipo de Contrato',
                'show' => 'Visualizar Tipo de Contrato',
                'edit' => 'Editar Tipo de Contrato',
            ],

            'filters' => [
                'name' => 'Buscar Tipo de Contrato',
                'total' => 'Total de Tipos de Contrato: ',
                'is_internal' => 'Interno o Externo',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'is_internal' => 'Interno o Externo',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
            ],

            'form' => [
                'is_internal' => 'Seleccione si es interno o externo.',
            ],

            'options' => [
                'internal' => 'Interno',
                'external' => 'Externo',
            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el Tipo de Contrato?',

                'save_success' => 'Se ha registrado correctamente el Tipo de Contrato: :assignment_contract.',
                'save_error' => 'No se ha registrado el Tipo de Contrato.',

                'update_success' => 'Se ha actualizado correctamente el Tipo de Contrato: :assignment_contract.',
                'update_error' => 'No se ha actualizado el Tipo de Contrato.',

                'delete_success' => 'Se ha eliminado el Tipo de Contrato: :assignment_contract.',
                'delete_error' => 'No se ha eliminado el Tipo de Contrato.'
            ],

            'title-show' => 'Perfil de Visualización del Tipo de Contrato',
            'title-form' => 'Formulario de Registro de Tipo de Contrato',
            'title-update' => 'Actualización del Tipo de Contrato',

            'info-create' => "En esta sección de la aplicación podrás realizar el registro del recurso TIPO DE CONTRATO DEL CREADOR. 
            Dicho recurso actualmente está destinado para enriquecer la información de los tipos de contrato dentro de la aplicación. ",

            'info-show' => "En esta sección de la aplicación podrás visualizar el tipo de contrato de :assignment_contract.",
        ],
    ]

];
