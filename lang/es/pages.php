<?php


return [
    'default' => [
        'create' => 'Registrar',

        'edit' => 'Editar',

        'title-information' => 'Información',

        'empty_table' => 'Actualmente no existen registros.'
    ],


    /**
     * Administrator Pages
     * 
     * Home Page
     * 
     * Resources:
     * 1. Localizations
     *  1.1. Countries
     *  1.2. States
     *  1.3. Cities
     * 
     * 2. Creators Information
     *  2.1. Document Types
     *  2.2. External Organizations
     *  2.3. Assignment Contract Types
     * 
     * 3. Intangible Assets
     *  3.1. States for Intangible Assets
     */
    'admin' => [

        /** Home Page */
        'home' => [
            'title' => 'Inicio',
        ],

        /** Localizations */
        'localizations' => [
            'title' => 'Localizaciones',

            /** Countries */
            'countries' => [

                'title' => 'Países',
                'subtitle' => 'Países',

                'route-titles' => [
                    'create' => 'Registrar País',
                    'show' => 'Visualizar País',
                    'edit' => 'Editar País',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del País',
                    'create' => 'Formulario de Registro de País',
                    'update' => 'Actualización del País',
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

                    'save_success' => "Se ha registrado correctamente el país: <b>:country</b>",
                    'save_error' => 'No se ha registrado el país.',

                    'update_success' => "Se ha actualizado correctamente el país: <b>:country</b>.",
                    'update_error' => 'No se ha actualizado el país.',

                    'delete_success' => 'Se ha eliminado el país: <b>:country</b>.',
                    'delete_error' => 'No se ha eliminado el país.'
                ],


                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>PAÍS</b>. 
                        Dicho recurso actualmente está destinado para enriquecer la información de los países dentro de la aplicación.
                       \n Hay que tener en cuenta que el único país que estará nutrida de información (Departamentos y Ciudades) 
                       será el país de Colombia.",

                    'show' => "En esta sección de la aplicación podrás visualizar el país de <b>:country</b>. \n
                        Este país actualmente tiene una cantidad de :states_count Departamentos y :cities_count ciudades.",
                ],


                'states' => [
                    'title' => 'Lista de Departamentos',
                ]
            ],

            /** States */
            'states' => [
                'title' => 'Departamentos',
                'subtitle' => 'Departamentos',

                'route-titles' => [
                    'create' => 'Registrar Departamento',
                    'show' => 'Visualizar Departamento',
                    'edit' => 'Editar Departamento',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Departamento',
                    'create' => 'Formulario de Registro de Departamento',
                    'update' => 'Actualización del Departamento',
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

                    'save_success' => "Se ha registrado correctamente el departamento: <b>:state</b>.",
                    'save_error' => 'No se ha registrado el departamento.',

                    'update_success' => "Se ha actualizado correctamente el departamento: <b>:state</b>.",
                    'update_error' => 'No se ha actualizado el departamento.',

                    'delete_success' => "Se ha eliminado el departamento: <b>:state</b>.",
                    'delete_error' => 'No se ha eliminado el departamento.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>DEPARTAMENTO</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de los departamentos dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar el departamento de <b>:state</b>. \n
                    Este departamento actualmente tiene una cantidad de :cities_count ciudades.",
                ],

                'cities' => [
                    'title' => 'Lista de Ciudades',
                ]
            ],

            /** Cities */
            'cities' => [
                'title' => 'Ciudades',
                'subtitle' => 'Ciudades',

                'route-titles' => [
                    'create' => 'Registrar Ciudad',
                    'show' => 'Visualizar Ciudad',
                    'edit' => 'Editar Ciudad',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Ciudad',
                    'create' => 'Formulario de Registro de Ciudad',
                    'update' => 'Actualización del Ciudad',
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

                    'save_success' => "Se ha registrado correctamente la ciudad: <b>:city</b>.",
                    'save_error' => 'No se ha registrado la ciudad.',

                    'update_success' => "Se ha actualizado correctamente la ciudad: <b>:city</b>.",
                    'update_error' => 'No se ha actualizado la ciudad.',

                    'delete_success' => "Se ha eliminado la ciudad: <b>:city</b>.",
                    'delete_error' => 'No se ha eliminado la ciudad.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>CIUDAD</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de las ciudades dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar la ciudad de <b>:city</b>.",
                ]
            ]
        ],

        /** Creators */
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
        ],

        /** Intangible Assets */
        'intangible_assets' => [
            'title' => 'Información de AI',

            'states' => [
                'title' => 'Estados',
                'subtitle' => 'Estados AI',

                'titles' => [
                    'create' => 'Registrar Estado de AI',
                    'show' => 'Visualizar Estado de AI',
                    'edit' => 'Editar Estado de AI',
                ],

                'filters' => [
                    'name' => 'Buscar Estado de AI',
                    'total' => 'Total de Estados AI: ',
                ],

                'table' => [
                    'head' => [
                        'name' => 'Nombre',
                        'description' => 'Descripción',
                        'created_at' => 'Fecha de Creación',
                        'updated_at' => 'Fecha de Actualización'
                    ],

                ],

                'messages' => [
                    'confirm' => '¿Estás seguro de que quieres eliminar el Estado de AI?',

                    'save_success' => 'Se ha registrado correctamente el Estado de AI: :state.',
                    'save_error' => 'No se ha registrado el Estado de AI.',

                    'update_success' => 'Se ha actualizado correctamente el Estado de AI: :state.',
                    'update_error' => 'No se ha actualizado el Estado de AI.',

                    'delete_success' => 'Se ha eliminado el Estado de AI: :state.',
                    'delete_error' => 'No se ha eliminado el Estado de AI.'
                ],

                'title-show' => 'Perfil de Visualización del Estado de AI',
                'title-form' => 'Formulario de Registro de Estado de AI',
                'title-update' => 'Actualización del Estado de AI',

                'info-create' => "En esta sección de la aplicación podrás realizar el registro del recurso ESTADOS ACTIVOS INTANGIBLES. 
                    Dicho recurso actualmente está destinado para enriquecer la información de los estados de los activos intangibles dentro de la aplicación. ",

                'info-show' => "En esta sección de la aplicación podrás visualizar el estado del AI de :state.",
            ],
        ]
    ],

    /** 
     * Client Pages
     * 
     * Home Page
     * 
     * Resources:
     * 
     * 1. Administrative Units
     */

    'client' => [

        /** Home Page */
        'home' => [
            'title' => 'Inicio',
        ],

        /** Administrative Units */
        'administrative_units' => [
            'title' => 'Subdirecciones Técnicas',
            'subtitle' => 'Subdirecciones Técnicas',

            'titles' => [
                'create' => 'Registrar Subdirección Técnica',
                'show' => 'Visualizar Subdirección Técnica',
                'edit' => 'Editar Subdirección Técnica',
            ],

            'filters' => [
                'name' => 'Buscar Subdirección Técnica',
                'total' => 'Total de Países: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'description' => 'Descripción',
                    'research_units' => 'Unidades de Investigación',
                    'cities' => 'Ciudades',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
                'body' => [
                    'research_units_count' => ':research_units_count Unidades de Investigación registradas.'
                ]

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar la subdirección técnica?',

                'save_success' => 'Se ha registrado correctamente la subdirección técnica: :administrative_unit.',
                'save_error' => 'No se ha registrado la subdirección técnica.',

                'update_success' => 'Se ha actualizado correctamente la subdirección técnica: :administrative_unit.',
                'update_error' => 'No se ha actualizado la subdirección técnica.',

                'delete_success' => 'Se ha eliminado la subdirección técnica: :administrative_unit.',
                'delete_error' => 'No se ha eliminado la subdirección técnica.'
            ],

            'title-show' => 'Perfil de Visualización de la Subdirección Técnica',
            'title-form' => 'Formulario de Registro de una Subdirección Técnica',
            'title-edit' => 'Actualización de la Subdirección Técnica',

            'info-create' => "En esta sección de la aplicación podrás realizar el registro del recurso SUBDIRECCIÓN TÉCNICA. 
                Dicho recurso actualmente está destinado para enriquecer la información de las subdirecciones técnicas dentro de la aplicación.",

            'info-show' => "En esta sección de la aplicación podrás visualizar el país de :administrative_unit. ",

            'states' => [
                'title' => 'Lista de Departamentos',
            ]
        ],
    ]
];
