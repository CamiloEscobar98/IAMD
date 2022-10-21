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
            [
                'name' => 'Subdirecciones Técnicas',
                'permissions' => [
                    [
                        'name' => 'administrative_units.create',
                        'info' => 'Visualizar Formulario de Registro de Subdirecciones Técnicas',
                    ],
                    [
                        'name' => 'administrative_units.index',
                        'info' => 'Visualizar Listado de Subdirecciones Técnicas',
                    ],
                    [
                        'name' => 'administrative_units.store',
                        'info' => 'Registro de Subdirecciones Técnicas',
                    ],
                    [
                        'name' => 'administrative_units.show',
                        'info' => 'Visualizar Formulario de Visualización de Subdirecciones Técnicas',
                    ],
                    [
                        'name' => 'administrative_units.edit',
                        'info' => 'Visualizar Formulario de Edición de Subdirecciones Técnicas',
                    ],
                    [
                        'name' => 'administrative_units.update',
                        'info' => 'Actualización de Subdirecciones Técnicas',
                    ],
                    [
                        'name' => 'administrative_units.destroy',
                        'info' => 'Eliminación de Subdirecciones Técnicas',
                    ],
                ]
            ],
            [
                'name' => 'Unidades de Investigación',
                'permissions' => [
                    [
                        'name' => 'research_units.create',
                        'info' => 'Visualizar Formulario de Registro de Unidades de Investigación',
                    ],
                    [
                        'name' => 'research_units.index',
                        'info' => 'Visualizar Listado de Unidades de Investigación',
                    ],
                    [
                        'name' => 'research_units.store',
                        'info' => 'Registro de Unidades de Investigación',
                    ],
                    [
                        'name' => 'research_units.show',
                        'info' => 'Visualizar Formulario de Visualización de Unidades de Investigación',
                    ],
                    [
                        'name' => 'research_units.edit',
                        'info' => 'Visualizar Formulario de Edición de Unidades de Investigación',
                    ],
                    [
                        'name' => 'research_units.update',
                        'info' => 'Actualización de Unidades de Investigación',
                    ],
                    [
                        'name' => 'research_units.destroy',
                        'info' => 'Eliminación de Unidades de Investigación',
                    ],
                ]
            ],
            [
                'name' => 'Proyectos',
                'permissions' => [
                    [
                        'name' => 'projects.create',
                        'info' => 'Visualizar Formulario de Registro de Proyectos',
                    ],
                    [
                        'name' => 'projects.index',
                        'info' => 'Visualizar Listado de Proyectos',
                    ],
                    [
                        'name' => 'projects.store',
                        'info' => 'Registro de Proyectos',
                    ],
                    [
                        'name' => 'projects.show',
                        'info' => 'Visualizar Formulario de Visualización de Proyectos',
                    ],
                    [
                        'name' => 'projects.edit',
                        'info' => 'Visualizar Formulario de Edición de Proyectos',
                    ],
                    [
                        'name' => 'projects.update',
                        'info' => 'Actualización de Proyectos',
                    ],
                    [
                        'name' => 'projects.destroy',
                        'info' => 'Eliminación de Proyectos',
                    ],
                ]
            ],
            [
                'name' => 'Activos Intangibles',
                'permissions' => [
                    [
                        'name' => 'intangible_assets.create',
                        'info' => 'Visualizar Formulario de Registro de Activos Intangibles',
                    ],
                    [
                        'name' => 'intangible_assets.index',
                        'info' => 'Visualizar Listado de Activos Intangibles',
                    ],
                    [
                        'name' => 'intangible_assets.store',
                        'info' => 'Registro de Activos Intangibles',
                    ],
                    [
                        'name' => 'intangible_assets.show',
                        'info' => 'Visualizar Formulario de Visualización de Activos Intangibles',
                    ],
                    [
                        'name' => 'intangible_assets.edit',
                        'info' => 'Visualizar Formulario de Edición de Activos Intangibles',
                    ],
                    [
                        'name' => 'intangible_assets.update',
                        'info' => 'Actualización de Activos Intangibles',
                    ],
                    [
                        'name' => 'intangible_assets.destroy',
                        'info' => 'Eliminación de Activos Intangibles',
                    ],
                ]
            ],
            [
                'name' => 'Creadores Internos',
                'permissions' => [
                    [
                        'name' => 'creators.internal.create',
                        'info' => 'Visualizar Formulario de Registro de Creadores Internos',
                    ],
                    [
                        'name' => 'creators.internal.index',
                        'info' => 'Visualizar Listado de Creadores Internos',
                    ],
                    [
                        'name' => 'creators.internal.store',
                        'info' => 'Registro de Creadores Internos',
                    ],
                    [
                        'name' => 'creators.internal.show',
                        'info' => 'Visualizar Formulario de Visualización de Creadores Internos',
                    ],
                    [
                        'name' => 'creators.internal.edit',
                        'info' => 'Visualizar Formulario de Edición de Creadores Internos',
                    ],
                    [
                        'name' => 'creators.internal.update',
                        'info' => 'Actualización de Creadores Internos',
                    ],
                    [
                        'name' => 'creators.internal.destroy',
                        'info' => 'Eliminación de Creadores Internos',
                    ],
                ]
            ],
            [
                'name' => 'Creadores Externos',
                'permissions' => [
                    [
                        'name' => 'creators.external.create',
                        'info' => 'Visualizar Formulario de Registro de Creadores Externos',
                    ],
                    [
                        'name' => 'creators.external.index',
                        'info' => 'Visualizar Listado de Creadores Externos',
                    ],
                    [
                        'name' => 'creators.external.store',
                        'info' => 'Registro de Creadores Externos',
                    ],
                    [
                        'name' => 'creators.external.show',
                        'info' => 'Visualizar Formulario de Visualización de Creadores Externos',
                    ],
                    [
                        'name' => 'creators.external.edit',
                        'info' => 'Visualizar Formulario de Edición de Creadores Externos',
                    ],
                    [
                        'name' => 'creators.external.update',
                        'info' => 'Actualización de Creadores Externos',
                    ],
                    [
                        'name' => 'creators.external.destroy',
                        'info' => 'Eliminación de Creadores Externos',
                    ],
                ]
            ],
            [
                'name' => 'Usuarios',
                'permissions' => [
                    [
                        'name' => 'users.create',
                        'info' => 'Visualizar Formulario de Registro de Usuarios',
                    ],
                    [
                        'name' => 'users.index',
                        'info' => 'Visualizar Listado de Usuarios',
                    ],
                    [
                        'name' => 'users.store',
                        'info' => 'Registro de Usuarios',
                    ],
                    [
                        'name' => 'users.show',
                        'info' => 'Visualizar Formulario de Visualización de Usuarios',
                    ],
                    [
                        'name' => 'users.edit',
                        'info' => 'Visualizar Formulario de Edición de Usuarios',
                    ],
                    [
                        'name' => 'users.update',
                        'info' => 'Actualización de Usuarios',
                    ],
                    [
                        'name' => 'users.destroy',
                        'info' => 'Eliminación de Usuarios',
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
                'info' => 'Administrador'
            ],
            [
                'name' => 'employee',
                'info' => 'Empleado'
            ]
        ]
    ]
];
