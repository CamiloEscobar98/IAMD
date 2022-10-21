<?php


return [
    'default' => [
        'home' => 'Inicio',

        'profile' => 'Perfil',

        'create' => 'Registrar',

        'edit' => 'Editar',

        'title-information' => 'Información',

        'empty_table' => 'Actualmente no existen registros.',

        'empty_field' => 'Vacío',
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

        /** Profile Page */
        'profile' => [
            'title' => 'Perfil',
            'subtitle' => 'Perfil',
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
        ],

        'intellectual_property_rights' => [
            'title' => 'Derechos de Propiedad Intelectual',

            /** Categories */
            'categories' => [
                'title' => 'Categorias',
                'subtitle' => 'Categorias de los Derechos de Propiedad Intelectual',

                'route-titles' => [
                    'create' => 'Registrar Categoria de Derecho de Propiedad Intelectual',
                    'show' => 'Visualizar Categoria de Derecho de Propiedad Intelectual',
                    'edit' => 'Editar Categoria de Derecho de Propiedad Intelectual',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Categoria de Derecho de Propiedad Intelectual',
                    'create' => 'Formulario de Registro de Categoria de Derecho de Propiedad Intelectual',
                    'update' => 'Actualización del Categoria de Derecho de Propiedad Intelectual',
                ],

                'filters' => [
                    'name' => 'Buscar Categoria de Derecho de Propiedad Intelectual',
                    'total' => 'Total de Categorias: ',
                ],

                'table' => [
                    'head' => [
                        'name' => 'Nombre',
                        'subcategories' => 'Subcategorias',
                        'products' => 'Productos',
                        'created_at' => 'Fecha de Creación',
                        'updated_at' => 'Fecha de Actualización'
                    ],
                    'body' => [
                        'intellectual_property_right_subcategories_count' => ':count Subcategorias de los Derechos de Propiedad Intelectual registradas.',
                        'intellectual_property_right_products_count' => ':count Productos de los Derechos de Propiedad Intelectual.'
                    ]

                ],

                'messages' => [
                    'confirm' => '¿Estás seguro de que quieres eliminar el Categoria de Derecho de Propiedad Intelectual?',

                    'save_success' => 'Se ha registrado correctamente el Categoria de Derecho de Propiedad Intelectual: :category.',
                    'save_error' => 'No se ha registrado el Categoria de Derecho de Propiedad Intelectual.',

                    'update_success' => 'Se ha actualizado correctamente el Categoria de Derecho de Propiedad Intelectual: :category.',
                    'update_error' => 'No se ha actualizado el Categoria de Derecho de Propiedad Intelectual.',

                    'delete_success' => 'Se ha eliminado el Categoria de Derecho de Propiedad Intelectual: :category.',
                    'delete_error' => 'No se ha eliminado el Categoria de Derecho de Propiedad Intelectual.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>CATEGORIAS DE LOS DERECHOS DE PROPIEDAD INTELECTUAL</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de las categorias de los derechos de propiedad intelectual dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar la Categoria de Derechos de Propiedad Intelectual <b>:category</b>. \n
                    Este país actualmente tiene una cantidad de :subcategories_count Subcategorias y :products_count Productos de Derechos de Propiedad Intelectual.",
                ]
            ],

            /** Subategories */
            'subcategories' => [
                'title' => 'Subcategorías',
                'subtitle' => 'Subcategorías de los Derechos de Propiedad Intelectual',

                'route-titles' => [
                    'create' => 'Registrar Subcategoría de Derecho de Propiedad Intelectual',
                    'show' => 'Visualizar Subcategoría de Derecho de Propiedad Intelectual',
                    'edit' => 'Editar Subcategoría de Derecho de Propiedad Intelectual',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización de la Subcategoría de Derecho de Propiedad Intelectual',
                    'create' => 'Formulario de Registro de Subcategoría de Derecho de Propiedad Intelectual',
                    'update' => 'Actualización de la Subcategoría de Derecho de Propiedad Intelectual',
                ],

                'filters' => [
                    'name' => 'Buscar Subcategoría de Derecho de Propiedad Intelectual',
                    'total' => 'Total de Subcategorías: ',
                ],

                'table' => [
                    'head' => [
                        'name' => 'Nombre',
                        'category' => 'Categoria',
                        'products' => 'Productos',
                        'created_at' => 'Fecha de Creación',
                        'updated_at' => 'Fecha de Actualización'
                    ],
                    'body' => [
                        'intellectual_property_right_products_count' => ':count Productos de los Derechos de Propiedad Intelectual.'
                    ]

                ],

                'messages' => [
                    'confirm' => '¿Estás seguro de que quieres eliminar la Subcategoría de Derecho de Propiedad Intelectual?',

                    'save_success' => 'Se ha registrado correctamente la Subcategoría de Derecho de Propiedad Intelectual: :subcategory.',
                    'save_error' => 'No se ha registrado la Subcategoría de Derecho de Propiedad Intelectual.',

                    'update_success' => 'Se ha actualizado correctamente la Subcategoría de Derecho de Propiedad Intelectual: :subcategory.',
                    'update_error' => 'No se ha actualizado la Subcategoría de Derecho de Propiedad Intelectual.',

                    'delete_success' => 'Se ha eliminado la Subcategoría de Derecho de Propiedad Intelectual: :subcategory.',
                    'delete_error' => 'No se ha eliminado la Subcategoría de Derecho de Propiedad Intelectual.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>SUBCATEGORIAS DE LOS DERECHOS DE PROPIEDAD INTELECTUAL</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de las subcategorias de los derechos de propiedad intelectual dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar la Subcategoría de Derechos de Propiedad Intelectual <b>:subcategory</b>. \n
                    Este país actualmente tiene una cantidad de :products_count Productos de Derechos de Propiedad Intelectual.",
                ]
            ],

            /** Products */
            'products' => [
                'title' => 'Productos',
                'subtitle' => 'Productos de los Derechos de Propiedad Intelectual',

                'route-titles' => [
                    'create' => 'Registrar Producto de Derecho de Propiedad Intelectual',
                    'show' => 'Visualizar Producto de Derecho de Propiedad Intelectual',
                    'edit' => 'Editar Producto de Derecho de Propiedad Intelectual',
                ],

                'form-titles' => [
                    'show' => 'Perfil de Visualización del Producto de Derecho de Propiedad Intelectual',
                    'create' => 'Formulario de Registro de Producto de Derecho de Propiedad Intelectual',
                    'update' => 'Actualización del Producto de Derecho de Propiedad Intelectual',
                ],

                'filters' => [
                    'name' => 'Buscar Producto de Derecho de Propiedad Intelectual',
                    'total' => 'Total de Productos: ',
                ],

                'table' => [
                    'head' => [
                        'name' => 'Nombre',
                        'category' => 'Categoria',
                        'subcategory'  => 'Subcategoria',
                        'products' => 'Productos',
                        'created_at' => 'Fecha de Creación',
                        'updated_at' => 'Fecha de Actualización'
                    ],
                ],

                'messages' => [
                    'confirm' => '¿Estás seguro de que quieres eliminar el Producto de Derecho de Propiedad Intelectual?',

                    'save_success' => 'Se ha registrado correctamente el Producto de Derecho de Propiedad Intelectual: :product.',
                    'save_error' => 'No se ha registrado el Producto de Derecho de Propiedad Intelectual.',

                    'update_success' => 'Se ha actualizado correctamente el Producto de Derecho de Propiedad Intelectual: :product.',
                    'update_error' => 'No se ha actualizado el Producto de Derecho de Propiedad Intelectual.',

                    'delete_success' => 'Se ha eliminado el Producto de Derecho de Propiedad Intelectual: :product.',
                    'delete_error' => 'No se ha eliminado el Producto de Derecho de Propiedad Intelectual.'
                ],

                'info' => [
                    'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>PRODUCTOS DE LOS DERECHOS DE PROPIEDAD INTELECTUAL</b>. 
                    Dicho recurso actualmente está destinado para enriquecer la información de los productos de los derechos de propiedad intelectual dentro de la aplicación. ",

                    'show' => "En esta sección de la aplicación podrás visualizar el Producto de Derechos de Propiedad Intelectual <b>:product</b>",
                ]
            ]
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
            'subtitle' => 'Dashboard',

            'main' => 'Principal',

            'config' => 'Configuración'
        ],

        /** Profile Page */
        'profile' => [
            'title' => 'Perfil',
            'subtitle' => 'Perfil',

            'form-titles' => [
                'show' => 'Información del Usuario',
                'password' => 'Contraseña de Acceso',
            ],

            'messages' => [
                'update_success' => 'Se ha actualizado correctamente el Usuario Autenticado.',
                'update_error' => 'No se ha actualizado el Usuario Autenticado.',

                'update_password_success' => 'Se ha actualizado correctamente la contraseña del Usuario Autenticado.',
                'update_password_error' => 'No se ha actualizado la contraseña.',
            ]
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

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Subdirecciones Técnicas registradas.'
            ],
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

                'directors' => 'Buscar por Director',
                'inventory_managers' => 'Buscar por Administrador de Inventario',

                'total' => 'Total de Unidades Investigativas: ',
            ],

            'table' => [
                'head' => [
                    'administrative_unit' => 'Subdirección Técnica',
                    'name' => 'Nombre',
                    'code' => 'Código',
                    'research_unit_category' => 'Categoría',
                    'director' => 'Director',
                    'inventory_manager' => 'Administrador de Inventario',
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

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Unidades Investigativas registradas.'
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
                    'administrative_unit' => 'Subdirección Técnica',
                    'research_unit' => 'Unidad Investigativa',
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

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Proyectos registrados.'
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

                    'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Creadores Internos. La información del recurso será: <b>:creator_internal</b>",

                    'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Creadores Internos registrados.'
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

                    'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Creadores Externos. La información del recurso será: <b>:creator_external</b>",

                    'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Creadores Externos registrados.'
                ],
            ]
        ],

        /** Intangible Assets */
        'intangible_assets' => [
            'title' => 'Activos Intangibles',
            'subtitle' => 'Activos Intangibles',

            'strategies' => [
                'title' => 'Estrategias de Gestión',
                'button' => 'Actualizar Estrategias de Gestión',
                'form' => [
                    'has_strategies' => '¿El Activo Intangible tiene interés de protegerse?',

                    'strategies' => 'Estrategias de Gestión:',
                    'users' => 'Usuario Responsable:'
                ],
                'list' => [
                    'strategy' => 'Estrategia de Gestión:',
                    'user' => 'Usuario Responsable:',
                ],
                'buttons' => [
                    'list' => 'Lista de Estrategias asociadas al Activo Intangible'
                ],
                'messages' => [
                    'save_success' => 'Se ha registrado el interés de protegerse con las Estrategias de Gestión al Activo Intangible.',
                    'save_error' => 'No se pudo registrar el interés de protegerse con las Estrategias de Gestión.',

                    'save_strategy_success' => 'Se ha registrado la Estrategia de Gestión al Activo Intangible.',
                    'save_strategy_error' => 'No se pudo registrar la Estrategia de Gestión.',

                    'confirm' => '¿Estás seguro de que quieres desasociar la estrategia del Activo Intangible?',

                    'delete_success' => 'Se ha desasociado del Activo Intangible',
                    'delete_error' => 'No se ha desasociado del Activo Intangible'
                ]
            ],

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
                    'administrative_unit' => 'Subdirección Técnica',
                    'research_unit' => 'Unidad Investigativa',
                    'project' => 'Proyecto',

                    'name' => 'Nombre',
                    'status' => 'Estado de las Fases',

                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
                'body' => []

            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el activo intangible?',

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

                'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Activos Intangibles. La información del recurso será: <b>:intangible_asset</b>",

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Activos Intangibles registrados.'
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
                        'save_success' => 'Se ha registrado correctamente la clasificación del Activo Intangible.',
                        'save_error' => 'No se pudo registrar la clasificación.',
                    ]

                ],
                'two' => [
                    'title' => 'Descripción del Activo',

                    'messages' => [
                        'save_success' => 'Se ha registrado correctamente la descripción del Activo Intangible.',
                        'save_error' => 'No se pudo registrar la descripción.',
                    ]
                ],
                'three' => [
                    'title' => 'Estado del Activo',

                    'messages' => [
                        'save_success' => 'Se ha registrado correctamente el estado del Activo Intangible.',
                        'save_error' => 'No se pudo registrar el estado.',
                    ]
                ],
                'four' => [
                    'title' => 'Derechos de Propiedad Intelectual',

                    'messages' => [
                        'save_success' => 'Se ha registrado correctamente los derechos de propiedad intelectual del Activo Intangible.',
                        'save_error' => 'No se pudo registrar los derechos de propiedad intelectual.',
                    ]
                ],
                'five' => [
                    'title' => 'Estado Actual del Activo Intangible',
                    'sub_phases' => [
                        'is_published' => [
                            'title' => '¿El Activo Intangible ha sido publicado o divulgado?',
                            'form' => [
                                'published_in' => 'Medio de publicación o divulgación:',
                                'information_scope' => 'Alcance de la publicación o divulgación:',
                                'published_date' => 'Fecha de la publicación o divulgación:',
                            ],
                            'messages' => [
                                'save_success' => 'Se ha registrado el estado de publicación y/o divulgación del Activo Intangible.',
                                'save_error' => 'No se pudo registrar el estado de publicación y/o divulgación.',
                            ]
                        ],

                        'confidenciality_contract' => [
                            'title' => '¿El Activo Intangible tiene contrato de confidencialidad firmado?',
                            'form' => [
                                'organization_confidenciality' => '¿Con quién se hizo el Contrato de Confidencialidad?',
                                'file' => 'Contrato de Confidencialidad:',
                            ],
                            'messages' => [
                                'save_success' => 'Se ha registrado el contrato de confidencialidad del Activo Intangible.',
                                'save_error' => 'No se pudo registrar el contrato de confidencialidad.',
                            ],
                            'buttons' => [
                                'download' => 'Descargar Contrato de Confidencialidad'
                            ]
                        ],

                        'creators' => [
                            'messages' => [
                                'save_success' => 'Se ha registrado estos creadores al del Activo Intangible.',
                                'save_error' => 'No se han podido registrar estos creadores al Activo Intangible',
                            ],
                        ],

                        'session_right_contract' => [
                            'title' => '¿El Activo Intangible tiene contrato de sesión de derechos patrimoniales?',
                            'form' => [
                                'owner' => 'Actual titular de los derechos de propiedad intelectual:',
                                'file' => 'Contrato de Titularidad de los Derechos de Propiedad Intelectual:',
                            ],
                            'messages' => [
                                'save_success' => 'Se ha registrado el contrato de sesión de derechos patrimoniales del Activo Intangible.',
                                'save_error' => 'No se pudo registrar el contrato de sesión de derechos patrimoniales.',
                            ],
                            'buttons' => [
                                'download' => 'Descargar Contrato de Sesión de Derechos Patrimoniales'
                            ]
                        ],

                        'contability' => [
                            'title' => '¿Se encuentra incorporado a la contabilidad como Activo Intangible?',
                            'form' => [
                                'price' => '¿Cuál es el valor del Activo Intangible?',
                                'comments' => 'Comentarios del Activo Intangible sobre la Contabilidad'
                            ],
                            'messages' => [
                                'save_success' => 'Se ha registrado la contabilidad del Activo Intangible.',
                                'save_error' => 'No se pudo registrar la contabilidad.',
                            ],
                        ]

                    ],
                ],

                'six' => [
                    'title' => 'Comentarios del Activo Intangible',

                    'form' => [
                        'message' => 'Redacta un nuevo comentario:'
                    ],

                    'messages' => [
                        'save_success' => 'Se ha registrado correctamente un mensaje del Activo Intangible.',
                        'save_error' => 'No se pudo registrar el mensaje.',
                    ]
                ],

                'seven' => [
                    'title' => 'Plan de Acción y Protección del Activo Intangible',

                    'sub_phases' => [
                        'has_deposite' => [
                            'title' => '¿Existe un depósito ante la autoridad competente para el derecho de autor?',
                            'form' => [
                                'deposite_reference' => 'Digite el número de referencia:'
                            ],
                            'messages' => [
                                'save_success' => 'Se ha registrado el número de referencia del depósito del Activo Intangible.',
                                'save_error' => 'No se pudo registrar el número de referencia del depósito.',
                            ]
                        ],
                        'has_secret_protection' => [
                            'title' => '¿Sugiere tomar medidas razonables para la protección de los secretos empresariales?',

                            'messages' => [
                                'save_success' => 'Se ha registrado las medidas secretas de protección del Activo Intangible.',
                                'save_error' => 'No se pudo registrar las medidas secretas de protección.',
                            ]
                        ]
                    ]
                ],

                'eight' => [
                    'title' => 'Priorización y Decisión del Activo Intangible',

                    'sub_phases' => [
                        'has_tool' => [
                            'title' => '¿Se debe de realizar una búsqueda relacionada con los potenciales derechos de propiedad intelectual asociadas al Activo Intangible?',
                            'form' => [
                                'tools' => 'Seleccione las herramientas de priorización para el derecho de propiedad intelectual: <b>:name</b>'
                            ],
                            'messages' => [
                                'save_success' => 'Se han registrado las herramientas de priorizacion al Activo Intangible.',
                                'save_error' => 'No se pudo registrar las herramientas de priorizacion.',
                            ]
                        ],
                    ]
                ],
                'nine' => [
                    'title' => 'Activo Intangible de Uso Comercial',
                    'sub_phases' => [
                        'is_commercial' => [
                            'title' => '¿Los Derechos de Propiedad Intelectual asociados a este Activo Intangible tienen algún uso comercial?',
                            'form' => [
                                'reason' => 'Describa el uso comercial que tendrá este Activo Intangible:'
                            ],
                            'messages' => [
                                'save_success' => 'Se ha registrado el uso comercial al Activo Intangible.',
                                'save_error' => 'No se pudo registrar el uso comercial.',
                            ]
                        ],

                    ]
                ]
            ],

            'reports' => [
                'single' => [
                    'messages' => [
                        'generate_success' => 'Se está generando el reporte del Activo Intangible',
                        'generate_error' => 'No se ha podido generar el reporte del Activo Intangible'
                    ]
                ]
            ]
        ],

        'users' => [
            'title' => 'Usuarios del Sistema',
            'subtitle' => 'Usuarios',

            'route-titles' => [
                'create' => 'Registrar Usuario',
                'show' => 'Visualizar Usuario',
                'edit' => 'Editar Usuario',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización del Usuario',
                'create' => 'Formulario de Registro de un Usuario',
                'edit' => 'Actualización del Usuario',
            ],

            'filters' => [
                'email' => 'Buscar Usuario por Email',
                'total' => 'Total de Usuarios: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'email' => 'Email',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el Usuario?',

                'save_success' => 'Se ha registrado correctamente el Usuario: <b>:user</b>',
                'save_error' => 'No se ha registrado el Usuario.',

                'update_success' => 'Se ha actualizado correctamente el Usuario: <b>:user</b>',
                'update_error' => 'No se ha actualizado el Usuario.',

                'delete_success' => 'Se ha eliminado el Usuario: <b>:user</b>',
                'delete_error' => 'No se ha eliminado el Usuario.',
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>USUARIOS DEL SISTEMA</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de los usuarios dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar toda la información del Usuario <b>:user</b> ",

                'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Usuarios del Sistema. La información del recurso será: <b>:user</b>",

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Usuarios del Sistema registrados.'
            ],

            'reports' => [
                'title' => 'Reportes Generados por el Usuario',
                'subtitle' => 'Reportes Generados',
                'messages' => [
                    'download_error' => 'No se ha podido descargar correctamente el reporte.'
                ]
            ]
        ],

        'priority_tools' => [
            'title' => 'Herramientas de Priorización',
            'subtitle' => 'Herramientas de Priorización',

            'route-titles' => [
                'create' => 'Registrar Herramienta de Priorización',
                'show' => 'Visualizar Herramienta de Priorización',
                'edit' => 'Editar Herramienta de Priorización',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización de la Herramienta de Priorización',
                'create' => 'Formulario de Registro de una Herramienta de Priorización',
                'edit' => 'Actualización de la Herramienta de Priorización',
            ],

            'filters' => [
                'name' => 'Buscar Herramienta de Priorización',
                'total' => 'Total de Herramientas de Priorización: ',
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
                'confirm' => '¿Estás seguro de que quieres eliminar la Herramienta de Priorización?',

                'save_success' => 'Se ha registrado correctamente la Herramienta de Priorización: <b>:priority_tool</b>',
                'save_error' => 'No se ha registrado la Herramienta de Priorización.',

                'update_success' => 'Se ha actualizado correctamente la Herramienta de Priorización: <b>:priority_tool</b>',
                'update_error' => 'No se ha actualizado la Herramienta de Priorización.',

                'delete_success' => 'Se ha eliminado la Herramienta de Priorización: <b>:priority_tool</b>',
                'delete_error' => 'No se ha eliminado la Herramienta de Priorización.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>HERRAMIENTAS DE PRIORIZACIÓN</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de las Herramientas de Priorización dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar la Herramienta de Priorización <b>:priority_tool</b> ",

                'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Herramientas de Priorización. La información del recurso será: <b>:priority_tool</b>",

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Herramientas de Priorización registradas.'
            ],
        ],

        'strategies' => [
            'title' => 'Estrategias de Gestión',
            'subtitle' => 'Estrategias de Gestión',

            'route-titles' => [
                'create' => 'Registrar Estrategia de Gestión',
                'show' => 'Visualizar Estrategia de Gestión',
                'edit' => 'Editar Estrategia de Gestión',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización de la Estrategia de Gestión',
                'create' => 'Formulario de Registro de una Estrategia de Gestión',
                'edit' => 'Actualización de la Estrategia de Gestión',
            ],

            'filters' => [
                'name' => 'Buscar Estrategia de Gestión',
                'total' => 'Total de Estrategias de Gestión: ',
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
                'confirm' => '¿Estás seguro de que quieres eliminar la Estrategia de Gestión?',

                'save_success' => 'Se ha registrado correctamente la Estrategia de Gestión: <b>:strategy</b>',
                'save_error' => 'No se ha registrado la Estrategia de Gestión.',

                'update_success' => 'Se ha actualizado correctamente la Estrategia de Gestión: <b>:strategy</b>',
                'update_error' => 'No se ha actualizado la Estrategia de Gestión.',

                'delete_success' => 'Se ha eliminado la Estrategia de Gestión: <b>:strategy</b>',
                'delete_error' => 'No se ha eliminado la Estrategia de Gestión.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>ESTRATEGIAS DE GESTIÓN</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de las Estrategia de Gestión dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar la Estrategia de Gestión <b>:strategy</b> ",
                'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Estrategia de Gestión. La información del recurso será: <b>:strategy</b>",

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Estrategias de Gestión registradas.'
            ],
        ],

        'strategy_categories' => [
            'title' => 'Categorías de las Estrategias de Gestión',
            'subtitle' => 'Categorías de las Estrategias de Gestión',

            'route-titles' => [
                'create' => 'Registrar Categoría de la Estrategia de Gestión',
                'show' => 'Visualizar Categoría de la Estrategia de Gestión',
                'edit' => 'Editar Categoría de la Estrategia de Gestión',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización de la Categoría de la Estrategia de Gestión',
                'create' => 'Formulario de Registro de una Categoría de la Estrategia de Gestión',
                'edit' => 'Actualización de la Categoría de la Estrategia de Gestión',
            ],

            'filters' => [
                'name' => 'Buscar por Nombre',
                'code' => 'Buscar por Código',
                'total' => 'Total de Categorías de las Estrategias de Gestión: ',
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
                'confirm' => '¿Estás seguro de que quieres eliminar la Categoría de la Estrategia de Gestión?',

                'save_success' => 'Se ha registrado correctamente la Categoría de la Estrategia de Gestión: <b>:strategy_category</b>',
                'save_error' => 'No se ha registrado la Categoría de la Estrategia de Gestión.',

                'update_success' => 'Se ha actualizado correctamente la Categoría de la Estrategia de Gestión: <b>:strategy_category</b>',
                'update_error' => 'No se ha actualizado la Categoría de la Estrategia de Gestión.',

                'delete_success' => 'Se ha eliminado la Categoría de la Estrategia de Gestión: <b>:strategy_category</b>',
                'delete_error' => 'No se ha eliminado la Categoría de la Estrategia de Gestión.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>CATEGORÍAS DE LAS ESTRATEGIAS DE GESTIÓN</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de las Categorías de las Estrategias de Gestión dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar la Categoría de la Estrategia de Gestión <b>:strategy_category</b> ",
                'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Categoría de las Estrategias de Gestión. La información del recurso será: <b>:strategy_category</b>",

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Categorías de las Estrategias de Gestión registradas.'
            ],
        ],

        'financing_types' => [
            'title' => 'Financiaciones de Proyectos',
            'subtitle' => 'Financiaciones de Proyectos',

            'route-titles' => [
                'create' => 'Registrar Financiación de Proyectos',
                'show' => 'Visualizar Financiación de Proyectos',
                'edit' => 'Editar Financiación de Proyectos',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización de la Financiación de Proyectos',
                'create' => 'Formulario de Registro de una Financiación de Proyectos',
                'edit' => 'Actualización de la Financiación de Proyectos',
            ],

            'filters' => [
                'name' => 'Buscar por Nombre',
                'code' => 'Buscar por Código',
                'total' => 'Total de Financiación de Proyectos: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'code' => 'Código',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar la Financiación de Proyectos?',

                'save_success' => 'Se ha registrado correctamente la Financiación de Proyectos: <b>:financing_type</b>',
                'save_error' => 'No se ha registrado la Financiación de Proyectos.',

                'update_success' => 'Se ha actualizado correctamente la Financiación de Proyectos: <b>:financing_type</b>',
                'update_error' => 'No se ha actualizado la Financiación de Proyectos.',

                'delete_success' => 'Se ha eliminado la Financiación de Proyectos: <b>:financing_type</b>',
                'delete_error' => 'No se ha eliminado la Financiación de Proyectos.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>FINANCIACIONES DE PROYECTOS</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de las Financiaciones de Proyectos dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar la Financiación de Proyectos <b>:financing_type</b> ",
                'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Financiación de Proyectos. La información del recurso será: <b>:financing_type</b>",

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Tipos de Financiación de Proyectos registrados.'
            ],
        ],

        'project_contract_types' => [
            'title' => 'Contrato para Proyectos',
            'subtitle' => 'Contrato para Proyectos',

            'route-titles' => [
                'create' => 'Registrar Tipo de Contrato de Proyectos',
                'show' => 'Visualizar Tipo de Contrato de Proyectos',
                'edit' => 'Editar Tipo de Contrato de Proyectos',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización del Tipo de Contrato de Proyectos',
                'create' => 'Formulario de Registro de un Tipo de Contrato de Proyectos',
                'edit' => 'Actualización del Tipo de Contrato de Proyectos',
            ],

            'filters' => [
                'name' => 'Buscar por Nombre',
                'code' => 'Buscar por Código',
                'total' => 'Total de Tipo de Contrato de Proyectos: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'code' => 'Código',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar el Tipo de Contrato de Proyectos?',

                'save_success' => 'Se ha registrado correctamente el Tipo de Contrato de Proyectos: <b>:project_contract_type</b>',
                'save_error' => 'No se ha registrado el Tipo de Contrato de Proyectos.',

                'update_success' => 'Se ha actualizado correctamente el Tipo de Contrato de Proyectos: <b>:project_contract_type</b>',
                'update_error' => 'No se ha actualizado el Tipo de Contrato de Proyectos.',

                'delete_success' => 'Se ha eliminado el Tipo de Contrato de Proyectos: <b>:project_contract_type</b>',
                'delete_error' => 'No se ha eliminado el Tipo de Contrato de Proyectos.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>TIPOS DE CONTRATO PARA PROYECTOS</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de los Tipos de Contrato para Proyectos dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar el Tipo de Contrato de Proyectos <b>:project_contract_type</b> ",
                'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Tipo de Contrato de Proyectos. La información del recurso será: <b>:project_contract_type</b>",

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Tipos de Tipo de Contrato de Proyectos registrados.'
            ],
        ],

        'secret_protection_measures' => [
            'title' => 'Medidas Secretas de Protección',
            'subtitle' => 'Medidas Secretas de Protección',

            'route-titles' => [
                'create' => 'Registrar Media Secreta de Protección',
                'show' => 'Visualizar Media Secreta de Protección',
                'edit' => 'Editar Media Secreta de Protección',
            ],

            'form-titles' => [
                'show' => 'Perfil de Visualización de la Media Secreta de Protección',
                'create' => 'Formulario de Registro de una Media Secreta de Protección',
                'edit' => 'Actualización de la Media Secreta de Protección',
            ],

            'filters' => [
                'name' => 'Buscar Media Secreta de Protección',
                'total' => 'Total de Medidas Secretas de Protección: ',
            ],

            'table' => [
                'head' => [
                    'name' => 'Nombre',
                    'created_at' => 'Fecha de Creación',
                    'updated_at' => 'Fecha de Actualización'
                ],
            ],

            'messages' => [
                'confirm' => '¿Estás seguro de que quieres eliminar la Medida Secreta de Protección?',

                'save_success' => 'Se ha registrado correctamente la Medida Secreta de Protección: <b>:secret_protection_measure</b>',
                'save_error' => 'No se ha registrado la Medida Secreta de Protección.',

                'update_success' => 'Se ha actualizado correctamente la Medida Secreta de Protección: <b>:secret_protection_measure</b>',
                'update_error' => 'No se ha actualizado la Medida Secreta de Protección.',

                'delete_success' => 'Se ha eliminado la Medida Secreta de Protección: <b>:secret_protection_measure</b>',
                'delete_error' => 'No se ha eliminado la Medida Secreta de Protección.'
            ],

            'info' => [
                'create' => "En esta sección de la aplicación podrás realizar el registro del recurso <b>MEDIDAS SECRETAS DE PROTECCIÓN</b>. 
                Dicho recurso actualmente está destinado para enriquecer la información de las Medida Secreta de Protección dentro de la aplicación.",

                'show' => "En esta sección de la aplicación podrás visualizar la Medida Secreta de Protección <b>:secret_protection_measure</b> ",
                'edit' => "En esta sección de la aplicación podrás actualizar toda la información del rescurso Medida Secreta de Protección. La información del recurso será: <b>:secret_protection_measure</b>",

                'callout' => 'En la aplicación existe actualmente un total de <b>:count</b> Medidas Secretas de Protección registrados.'
            ],
        ],

        'reports' => [
            'title' => 'Reportes',
            'subtitle' => 'Reportes',

            'custom' => [
                'title' => 'Reporte Personalizado',
                'subtitle' => 'Personizable',
            ]
        ],
    ]
];
