<?php

return [

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => App\Models\Client\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => App\Models\Client\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        'permission_modules' => 'permission_modules',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'can_deleted' => false,
        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',
        'permission_module' => 'permission_module_id',

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your related model's
         * foreign key is other than `team_id`.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * When set to true, the method for checking permissions will be registered on the gate.
     * Set this to false, if you want to implement custom logic for checking permissions.
     */

    'register_permission_check_method' => true,

    /*
     * When set to true the package implements teams using the 'team_foreign_key'. If you want
     * the migrations to register the 'team_foreign_key', you must set this to true
     * before doing the migration. If you already did the migration then you must make a new
     * migration to also add 'team_foreign_key' to 'roles', 'model_has_roles', and
     * 'model_has_permissions'(view the latest version of package's migration file)
     */

    'teams' => false,

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],


    /**
     * Seeders configuration, you can use it with any seeder into your application.
     */
    'seeders' => [

        /**
         * Default permission modules for seeders.
         */
        'permission_modules' => [

            /** Administrative Units */
            [
                'name' => 'Facultades',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'administrative_units.index',
                        'info' => 'Visualizar las Facultades.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'administrative_units.store',
                        'info' => 'Visualizar el formulario y registrar las Facultades.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'administrative_units.show',
                        'info' => 'Visualizar la información detallada de las Facultades.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'administrative_units.update',
                        'info' => 'Actualizar la información de las Facultades.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'administrative_units.destroy',
                        'info' => 'Eliminar las Facultades.',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Research Units */
            [
                'name' => 'Unidades de Investigación',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'research_units.index',
                        'info' => 'Visualizar las Unidades de Investigación',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'research_units.store',
                        'info' => 'Visualizar el formulario y registrar las Unidades de Investigación',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'research_units.show',
                        'info' => 'Visualizar la información detallada de las Unidades de Investigación',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'research_units.update',
                        'info' => 'Actualización la información de Unidades de Investigación',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'research_units.destroy',
                        'info' => 'Eliminar las Unidades de Investigación',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Projects */
            [
                'name' => 'Proyectos',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'projects.index',
                        'info' => 'Visualizar los Proyectos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'projects.store',
                        'info' => 'Visualizar el formulario y registrar los Proyectos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'projects.show',
                        'info' => 'Visualizar la información detallada de los Proyectos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'projects.update',
                        'info' => 'Actualizar la información de los Proyectos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'projects.destroy',
                        'info' => 'Eliminar los Proyectos',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Intangible Assets */
            [
                'name' => 'Activos Intangibles',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'intangible_assets.index',
                        'info' => 'Visualizar los Activos Intangibles',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'intangible_assets.store',
                        'info' => 'Visualizar el formulario y registrar los Activos Intangibles',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'intangible_assets.show',
                        'info' => 'Visualizar la información detallada de los Activos Intangibles',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'intangible_assets.update',
                        'info' => 'Actualizar la información de los Activos Intangibles',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'intangible_assets.phases.update',
                        'info' => 'Visualizar y actualizar las fases del Activo Intangible',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'intangible_assets.destroy',
                        'info' => 'Eliminar los Activos Intangibles',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'intangible_assets.generate_report',
                        'info' => 'Generar Reporte Individual del Activo Intangible',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'intangible_assets.generate_code',
                        'info' => 'Generar Código del Activo Intangible',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'intangible_assets.strategies.index',
                        'info' => 'Visualizar las Estrategias de Gestión asociadas a un Activo Intangible',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Creators Internal */
            [
                'name' => 'Creadores Internos',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'creators.internal.index',
                        'info' => 'Visualizar los Creadores Internos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'creators.internal.store',
                        'info' => 'Visualizar el formulario y registrar los Creadores Internos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'creators.internal.show',
                        'info' => 'Visualizar la información detallada de los Creadores Internos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'creators.internal.update',
                        'info' => 'Actualizar la información de los Creadores Internos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'creators.internal.destroy',
                        'info' => 'Eliminar los Creadores Internos',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Creators External */
            [
                'name' => 'Creadores Externos',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'creators.external.index',
                        'info' => 'Visualizar los Creadores Externos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'creators.external.store',
                        'info' => 'Visualizar el formulario y registrar los Creadores Externos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'creators.external.show',
                        'info' => 'Visualizar la información detallada de los Creadores Externos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'creators.external.update',
                        'info' => 'Actualizar la información de los Creadores Externos',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'creators.external.destroy',
                        'info' => 'Eliminar los Creadores Externos',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Users */
            [
                'name' => 'Usuarios',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'users.index',
                        'info' => 'Visualizar los Usuarios',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'users.store',
                        'info' => 'Visualizar el formulario y registrar los Usuarios',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'users.show',
                        'info' => 'Visualizar la información detallada de los Usuarios',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'users.update',
                        'info' => 'Actualizar la información de los Usuarios',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'users.destroy',
                        'info' => 'Eliminar los Usuarios',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Roles */
            [
                'name' => 'Roles del Sistema',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'roles.index',
                        'info' => 'Visualizar los Roles.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'roles.store',
                        'info' => 'Visualizar el formulario y registrar los Roles.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'roles.show',
                        'info' => 'Visualizar la información detallada de los Roles.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'roles.update',
                        'info' => 'Actualizar la información de los Roles.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'roles.destroy',
                        'info' => 'Eliminar los Roles.',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Permissions */
            [
                'name' => 'Permisos del Sistema',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'permissions.index',
                        'info' => 'Visualizar los Permisos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'permissions.store',
                        'info' => 'Visualizar el formulario y registrar los Permisos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'permissions.show',
                        'info' => 'Visualizar la información detallada de los Permisos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'permissions.update',
                        'info' => 'Actualizar la información de los Permisos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'permissions.destroy',
                        'info' => 'Eliminar los Permisos.',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Strategy Categories */
            [
                'name' => 'Categorias de las Estrategias de Gestión',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'strategy_categories.index',
                        'info' => 'Visualizar las Categorias de las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'strategy_categories.store',
                        'info' => 'Visualizar el formulario y registrar las Categorias de las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'strategy_categories.show',
                        'info' => 'Visualizar la información detallada de las Categorias de las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'strategy_categories.update',
                        'info' => 'Actualizar la información de las Categorias de las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'strategy_categories.destroy',
                        'info' => 'Eliminar las Categorias de las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Strategies */
            [
                'name' => 'Estrategias de Gestión',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'strategies.index',
                        'info' => 'Visualizar las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'strategies.store',
                        'info' => 'Visualizar el formulario y registrar las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'strategies.show',
                        'info' => 'Visualizar la información detallada de las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'strategies.update',
                        'info' => 'Actualizar la información de las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'strategies.destroy',
                        'info' => 'Eliminar las Estrategias de Gestión.',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Financing Types */
            [
                'name' => 'Financiación de Proyectos',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'financing_types.index',
                        'info' => 'Visualizar las Financiaciones para los Proyectos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'financing_types.store',
                        'info' => 'Visualizar el formulario y registrar las Financiaciones para los Proyectos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'financing_types.show',
                        'info' => 'Visualizar la información detallada de las Financiaciones para los Proyectos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'financing_types.update',
                        'info' => 'Actualizar la información de las Financiaciones para los Proyectos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'financing_types.destroy',
                        'info' => 'Eliminar las Financiaciones para los Proyectos.',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Project Contract Types */
            [
                'name' => 'Contratación para Proyectos',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'project_contract_types.index',
                        'info' => 'Visualizar los Tipos de Contratación para los Proyectos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'project_contract_types.store',
                        'info' => 'Visualizar el formulario y registrar los Tipos de Contratación para los Proyectos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'project_contract_types.show',
                        'info' => 'Visualizar la información detallada de los Tipos de Contratación para los Proyectos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'project_contract_types.update',
                        'info' => 'Actualizar la información de los Tipos de Contratación para los Proyectos.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'project_contract_types.destroy',
                        'info' => 'Eliminar los Tipos de Contratación para los Proyectos.',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Priority Tools */
            [
                'name' => 'Herramientas de Priorización',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'priority_tools.index',
                        'info' => 'Visualizar las Herramientas de Priorización.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'priority_tools.store',
                        'info' => 'Visualizar el formulario y registrar las Herramientas de Priorización.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'priority_tools.show',
                        'info' => 'Visualizar la información detallada de las Herramientas de Priorización.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'priority_tools.update',
                        'info' => 'Actualizar la información de las Herramientas de Priorización.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'priority_tools.destroy',
                        'info' => 'Eliminar las Herramientas de Priorización.',
                        'can_deleted' => false,
                    ],
                ]
            ],

            /** Secret Protection Measures */
            [
                'name' => 'Medidas Secretas de Protección',
                'can_deleted' => false,
                'permissions' => [
                    [
                        'name' => 'secret_protection_measures.index',
                        'info' => 'Visualizar las Medidas Secretas de Protección.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'secret_protection_measures.store',
                        'info' => 'Visualizar el formulario y registrar las Medidas Secretas de Protección.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'secret_protection_measures.show',
                        'info' => 'Visualizar la información detallada de las Medidas Secretas de Protección.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'secret_protection_measures.update',
                        'info' => 'Actualizar la información de las Medidas Secretas de Protección.',
                        'can_deleted' => false,
                    ],
                    [
                        'name' => 'secret_protection_measures.destroy',
                        'info' => 'Eliminar las Medidas Secretas de Protección.',
                        'can_deleted' => false,
                    ],
                ]
            ],
        ],

        /**
         * Default roles for seeders.
         */
        'roles' => [
            [
                'name' => 'admin',
                'info' => 'Administrador',
                'can_deleted' => false,
            ],
            [
                'name' => 'employee',
                'info' => 'Empleado',
                'can_deleted' => false,
            ]
        ]
    ]
];
