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

            /** Document Types */
            'document_types' => [
                'title' => 'Tipos de Documento',
                'subtitle' => 'Tipos de Documento',

                'route-titles' => [
                    'create' => 'Registrar Tipo de Documento',
                    'show' => 'Visualizar Tipo de Documento',
                    'edit' => 'Editar Tipo de Documento',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Tipo de Documento',
                    'create' => 'Formulario de Registro de Tipo de Documento',
                    'update' => 'Actualización del Tipo de Documento',
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

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>TIPO DE DOCUMENTO</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de los tipos de documentos dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar el tipo de documento de <b>:document_type</b>.",
                ]

            ],

            /** External Organizations */
            'external_organizations' => [
                'title' => 'Organizaciones Externas',
                'subtitle' => 'Organizaciones Externas',

                'route-titles' => [
                    'create' => 'Registrar Organización Externa',
                    'show' => 'Visualizar Organización Externa',
                    'edit' => 'Editar Organización Externa',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización de la Organización Externa',
                    'create' => 'Formulario de Registro de Organización Externa',
                    'update' => 'Actualización de la Organización Externa',
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

                    'save_success' => 'Se ha registrado correctamente la Organización Externa: <b>:external_organization</b>.',
                    'save_error' => 'No se ha registrado la Organización Externa.',

                    'update_success' => 'Se ha actualizado correctamente la Organización Externa: <b>:external_organization</b>.',
                    'update_error' => 'No se ha actualizado la Organización Externa.',

                    'delete_success' => 'Se ha eliminado la Organización Externa: <b>:external_organization</b>.',
                    'delete_error' => 'No se ha eliminado la Organización Externa.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>ORGANIZACIÓN EXTERNA</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de las organizaciones externas dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar la organización externa de <b>:external_organization</b>.",
                ]
            ],

            /** Assignment Contracts */
            'assignment_contracts' => [
                'title' => 'Tipos de Contrato',
                'subtitle' => 'Tipos de Contrato',

                'route-titles' => [
                    'create' => 'Registrar Tipo de Contrato',
                    'show' => 'Visualizar Tipo de Contrato',
                    'edit' => 'Editar Tipo de Contrato',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Tipo de Contrato',
                    'create' => 'Formulario de Registro de Tipo de Contrato',
                    'update' => 'Actualización del Tipo de Contrato',
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

                    'save_success' => 'Se ha registrado correctamente el Tipo de Contrato: <b>:assignment_contract</b>.',
                    'save_error' => 'No se ha registrado el Tipo de Contrato.',

                    'update_success' => 'Se ha actualizado correctamente el Tipo de Contrato: <b>:assignment_contract</b>.',
                    'update_error' => 'No se ha actualizado el Tipo de Contrato.',

                    'delete_success' => 'Se ha eliminado el Tipo de Contrato: <b>:assignment_contract</b>.',
                    'delete_error' => 'No se ha eliminado el Tipo de Contrato.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>TIPO DE CONTRATO DEL CREADOR</b>. 
                     Dicho recurso actualmente está destinado para enriquecer la información de los tipos de contrato dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar el tipo de contrato de <b>:assignment_contract</b>.",
                ]
            ],
        ],

        /** Intangible Assets */
        'intangible_assets' => [
            'title' => 'Información de AI',

            /** Intangible Assets States */
            'states' => [
                'title' => 'Estados',
                'subtitle' => 'Estados AI',

                'route-titles' => [
                    'create' => 'Registrar Estado de AI',
                    'show' => 'Visualizar Estado de AI',
                    'edit' => 'Editar Estado de AI',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Estado de AI',
                    'form' => 'Formulario de Registro de Estado de AI',
                    'update' => 'Actualización del Estado de AI',
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

                    'save_success' => 'Se ha registrado correctamente el Estado de AI: <b>:state</b>.',
                    'save_error' => 'No se ha registrado el Estado de AI.',

                    'update_success' => 'Se ha actualizado correctamente el Estado de AI: <b>:state</b>.',
                    'update_error' => 'No se ha actualizado el Estado de AI.',

                    'delete_success' => 'Se ha eliminado el Estado de AI: <b>:state</b>.',
                    'delete_error' => 'No se ha eliminado el Estado de AI.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>ESTADOS DE LOS ACTIVOS INTANGIBLES</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de los estados de los activos intangibles dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar el Estado del Activo Intangible de <b>:state</b>",
                ]
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

            'route-titles' => [
                'create' => 'Registrar Subdirección Técnica',
                'show' => 'Visualizar Subdirección Técnica',
                'edit' => 'Editar Subdirección Técnica',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización de la Subdirección Técnica',
                'create' => 'Formulario de Registro de una Subdirección Técnica',
                'edit' => 'Actualización de la Subdirección Técnica',
            ],

            'filters' => [
                'name' => 'Buscar Subdirección Técnica',
                'total' => 'Total de Subdirecciones Técnicas: ',
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

                'save_success' => 'Se ha registrado correctamente la subdirección técnica: <b>:administrative_unit</b>',
                'save_error' => 'No se ha registrado la subdirección técnica.',

                'update_success' => 'Se ha actualizado correctamente la subdirección técnica: <b>:administrative_unit</b>',
                'update_error' => 'No se ha actualizado la subdirección técnica.',

                'delete_success' => 'Se ha eliminado la subdirección técnica: <b>:administrative_unit</b>',
                'delete_error' => 'No se ha eliminado la subdirección técnica.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>SUBDIRECCIÓN TÉCNICA</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de las subdirecciones técnicas dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar la subdirección técnica <b>:administrative_unit</b> ",
            ],

            'states' => [
                'title' => 'Lista de Departamentos',
            ]
        ],

        /** Research Units */
        'research_units' => [
            'title' => 'Unidades Investigativas',
            'subtitle' => 'Unidades Investigativas',

            'route-titles' => [
                'create' => 'Registrar Unidad Investigativa',
                'show' => 'Visualizar Unidad Investigativa',
                'edit' => 'Editar Unidad Investigativa',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización de la Unidad Investigativa',
                'create' => 'Formulario de Registro de una Unidad Investigativa',
                'edit' => 'Actualización de la Unidad Investigativa',
            ],

            'filters' => [
                'name' => 'Buscar Nombre Unidad Investigativa',
                'code' => 'Buscar Código Unidad Investigativa',

                'administrative_units' => 'Buscar por Subdirección Técnica',
                'research_unit_categories' => 'Buscar por Categoría de Unidad Investigativa',

                'total' => 'Total de Unidades Investigativas: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'code' => 'Código',
                    'description' => 'Descripción',
                    'projects' => 'Proyectos',
                    'cities' => 'Ciudades',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
                'body' => [
                    'projects_count' => ':projects proyectos registrados.'
                ]

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar la unidad investigativa?',

                'save_success' => 'Se ha registrado correctamente la unidad investigativa: <b>:research_unit</b>.',
                'save_error' => 'No se ha registrado la unidad investigativa.',

                'update_success' => 'Se ha actualizado correctamente la unidad investigativa: <b>:research_unit</b>.',
                'update_error' => 'No se ha actualizado la unidad investigativa.',

                'delete_success' => "Se ha eliminado la unidad investigativa: <p><b>:research_unit</b></p>.",
                'delete_error' => 'No se ha eliminado la unidad investigativa.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>UNIDAD INVESTIGATIVA</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de las unidades investigativas dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar la unidad investigativa de <b>:research_unit</b>. ",
            ],

            'projects' => [
                'title' => 'Lista de Proyectos',
            ]
        ],

        /** Projects */
        'projects' => [
            'title' => 'Proyectos',
            'subtitle' => 'Proyectos',

            'route-titles' => [
                'create' => 'Registrar Proyecto',
                'show' => 'Visualizar Proyecto',
                'edit' => 'Editar Proyecto',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización del Proyecto',
                'create' => 'Formulario de Registro de un Proyecto',
                'edit' => 'Actualización del Proyecto',
            ],

            'filters' => [
                'name' => 'Buscar Nombre Proyecto',

                'administrative_units' => 'Buscar por Subdirección Técnica',
                'research_units' => 'Buscar por Unidad Investigativa',

                'total' => 'Total de Proyectos: ',
            ],

            'table' => [
                'head' => [
                    'director' => 'Director',
                    'project_financing' => 'Financiación',
                    'name' => 'Nombre',
                    'description' => 'Descripción',

                    'intangible_assets' => 'Activos',

                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
                'body' => [
                    'intangible_assets_count' => ':intangible_assets Activos registrados.'
                ]

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el proyecto?',

                'save_success' => 'Se ha registrado correctamente el proyecto: <b>:project</b>.',
                'save_error' => 'No se ha registrado el proyecto.',

                'update_success' => 'Se ha actualizado correctamente el proyecto: <b>:project</b>.',
                'update_error' => 'No se ha actualizado el proyecto.',

                'delete_success' => "Se ha eliminado el proyecto: <p><b>:project</b></p>.",
                'delete_error' => 'No se ha eliminado el proyecto.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>PROYECTO</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de los proyectos dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar el proyecto de <b>:project</b>. ",
            ],

            'intangible_assets' => [
                'title' => 'Lista de Activos',
            ]
        ],

        /** Creators */
        'creators' => [

            /** Internal */
            'internal' => [

                'title' => 'Creadores Internos',
                'subtitle' => 'Creadores Internos',

                'route-titles' => [
                    'create' => 'Registrar Creador Interno',
                    'show' => 'Visualizar Creador Interno',
                    'edit' => 'Editar Creador Interno',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Creador Interno',
                    'create' => 'Formulario de Registro de una Creador Interno',
                    'edit' => 'Actualización del Creador Interno',
                ],

                'filters' => [
                    'name' => 'Buscar Creador Interno',
                    'document' => 'Buscar por Documento',

                    'linkage_types' => 'Tipo de Vinculación',
                    'assignment_contracts' => 'Tipo de Contratación',

                    'total' => 'Total de Creadores Internos: ',
                ],

                'table' => [
                    'head' => [
                        'name' => 'Nombre',
                        'document' => 'Documento de Identidad',
                        'phone' => 'Celular',
                        'linkage_type' => 'Vinculación',
                        'assignment_contract' => 'Contratación',
                        'created_at' => 'Fecha de Creación',
                        'updated_at' => 'Fecha de Actualización'
                    ],
                    'body' => [
                        'document' => ":document <br> <b>:type</b> <br> <b>:expedition</b>"
                    ]

                ],

                'messages' => [
                    'confirm' => '¿Estás seguro de que quieres eliminar el creador interno?',

                    'save_success' => 'Se ha registrado correctamente el creador interno: <b>:creator_internal</b>.',
                    'save_error' => 'No se ha registrado el creador interno.',

                    'update_success' => 'Se ha actualizado correctamente el creador interno: <b>:creator_internal</b>.',
                    'update_error' => 'No se ha actualizado el creador interno.',

                    'delete_success' => 'Se ha eliminado el creador interno: <b>:creator_internal</b>.',
                    'delete_error' => 'No se ha eliminado el creador interno.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>CREADOR INTERNO</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de los creadores internos dentro de la aplicación.",

                    'show' => "En esta sección de la aplicación podrás visualizar el creador externo <b>:creator_internal</b>. ",
                ],
            ],

            /** External */
            'external' => [

                'title' => 'Creadores Externos',
                'subtitle' => 'Creadores Externos',

                'route-titles' => [
                    'create' => 'Registrar Creador Externo',
                    'show' => 'Visualizar Creador Externo',
                    'edit' => 'Editar Creador Externo',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Creador Externo',
                    'create' => 'Formulario de Registro de una Creador Externo',
                    'edit' => 'Actualización del Creador Externo',
                ],

                'filters' => [
                    'name' => 'Buscar Creador Externo',
                    'document' => 'Buscar por Documento',

                    'external_organizations' => 'Organizaciones Externas',
                    'assignment_contracts' => 'Tipo de Contratación',

                    'total' => 'Total de Creadores Externos: ',
                ],

                'table' => [
                    'head' => [
                        'name' => 'Nombre',
                        'document' => 'Documento de Identidad',
                        'phone' => 'Celular',
                        'external_organization' => 'Organization Externa',
                        'assignment_contract' => 'Contratación',
                        'created_at' => 'Fecha de Creación',
                        'updated_at' => 'Fecha de Actualización'
                    ],
                    'body' => [
                        'document' => ":document <br> <b>:type</b> <br> <b>:expedition</b>"
                    ]

                ],

                'messages' => [
                    'confirm' => '¿Estás seguro de que quieres eliminar el creador externo?',

                    'save_success' => 'Se ha registrado correctamente el creador externo: <b>:creator_external</b>.',
                    'save_error' => 'No se ha registrado el creador externo.',

                    'update_success' => 'Se ha actualizado correctamente el creador externo: <b>:creator_external</b>.',
                    'update_error' => 'No se ha actualizado el creador externo.',

                    'delete_success' => 'Se ha eliminado el creador externo: <b>:creator_external</b>.',
                    'delete_error' => 'No se ha eliminado el creador externo.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>CREADOR EXTERNO</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de los creadores externos dentro de la aplicación.",

                    'show' => "En esta sección de la aplicación podrás visualizar el creador externo <b>:creator_external</b>. ",
                ],
            ]
        ],

        /** Intangible Assets */
        'intangible_assets' => [
            'title' => 'Activos Intangibles',
            'subtitle' => 'Activos Intangibles',

            'route-titles' => [
                'create' => 'Registrar Activo',
                'show' => 'Visualizar Activo',
                'edit' => 'Editar Activo',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización del Activo',
                'create' => 'Formulario de Registro de un Activo',
                'edit' => 'Actualización del Activo',
            ],

            'filters' => [
                'name' => 'Buscar Nombre Activo',

                'projects' => 'Buscar por Proyecto',

                'total' => 'Total de Activos Intangibles: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'description' => 'Descripción',

                    'project' => 'Proyecto',
                    'state' => 'Estado',

                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
                'body' => []

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el activo?',

                'save_success' => 'Se ha registrado correctamente el activo: <b>:intangible_asset</b>.',
                'save_error' => 'No se ha registrado el activo.',

                'update_success' => 'Se ha actualizado correctamente el activo: <b>:intangible_asset</b>.',
                'update_error' => 'No se ha actualizado el activo.',

                'delete_success' => "Se ha eliminado el activo: <p><b>:intangible_asset</b></p>.",
                'delete_error' => 'No se ha eliminado el activo.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>ACTIVO INTANGIBLE</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de los activos dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar el activo de <b>:intangible_asset</b>. ",
            ],

            'phases' => [
                'title' => 'Proceso de Registro',
                'one' => [
                    'title' => 'Clasificación del Activo',

                    'form' => [
                        'level_1' => 'Categoría',
                        'level_2' => 'Subcategoría',
                        'level_3' => 'Producto'
                    ],

                    'messages' => [
                        'save_success' => 'Se ha registrado correctamente la clasificación del Activo Intangible: <b>:intangible_asset</b>.',
                        'save_error' => 'No se pudo registrar la clasificación.',
                    ]

                ],
                'two' => [
                    'title' => 'Descripción del Activo',

                    'messages' => [
                        'save_success' => 'Se ha registrado correctamente la descripción del Activo Intangible: <b>:intangible_asset</b>.',
                        'save_error' => 'No se pudo registrar la descripción.',
                    ]
                ],
                'three' => [
                    'title' => 'Estado del Activo',

                    'messages' => [
                        'save_success' => 'Se ha registrado correctamente el estado del Activo Intangible: <b>:intangible_asset</b>.',
                        'save_error' => 'No se pudo registrar el estado.',
                    ]
                ],
                'four' => [
                    'title' => 'Derechos de Propiedad Intelectual',

                    'messages' => [
                        'save_success' => 'Se ha registrado correctamente los derechos de propiedad intelectual del Activo Intangible: <b>:intangible_asset</b>.',
                        'save_error' => 'No se pudo registrar los derechos de propiedad intelectual.',
                    ]
                ]
            ]
        ],
    ]
];
