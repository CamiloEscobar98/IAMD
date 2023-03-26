<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Spatie\Permission\PermissionServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\ComposerServiceProvider::class

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
    ])->toArray(),



    /** Default Intangible Asset Levels */
    'intellectual_property_right_categories' => [

        /** Category */
        [
            'name' => 'Propiedad Industrial',

            /** Subcategories */
            'subcategories' => [
                [
                    'name' => 'Diseño Industrial',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Diseños Industriales',
                            'code' => 'DI'
                        ]
                    ]
                ],

                [
                    'name' => 'Esquemas de Trazado de Circuito Integrado',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Esquemas de trazado de circuito integrado',
                            'code' => 'ECI'
                        ]
                    ]
                ],
                [
                    'name' => 'Nuevas Creaciones e Innovaciones',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Patente concedida',
                            'code' => 'PAC'
                        ],
                        [
                            'name' => 'Patente concedida y explotada',
                            'code' => 'PAA'
                        ],
                        [
                            'name' => 'Patente en trámite',
                            'code' => 'PAB'
                        ],
                    ]
                ],
                [
                    'name' => 'Prototipos Industriales',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Prototipos Industriales',
                            'code' => 'PI'
                        ]
                    ]
                ],
                [
                    'name' => 'Secretos Industriales',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Innovaciones generadas en la gestión empresarial',
                            'code' => 'IG'
                        ],
                        [
                            'name' => 'Secreto empresarial',
                            'code' => 'SE'
                        ],
                    ]
                ],
                [
                    'name' => 'Signos Distintivos',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Signos Distintivos',
                            'code' => 'SD',
                        ],
                        [
                            'name' => 'Marcas',
                            'code' => 'MA',
                        ],
                    ],
                ],
            ]
        ],

        /** Category */
        [
            'name' => 'Derecho de Autor',

            /** Subcategories */
            'subcategories' => [
                [
                    'name' => 'Derecho de Autor',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Acuerdo de Ley',
                            'code' => 'AL',
                        ],
                        [
                            'name' => 'Artículos de investigación',
                            'code' => 'ART'
                        ],
                        [
                            'name' => 'Boletines divulgativos de resultado de investigación',
                            'code' => 'BOL'
                        ],
                        [
                            'name' => 'Capítulos en libro resultado de investigación',
                            'code' => 'CAP_LIB'
                        ],
                        [
                            'name' => 'Direcciones de tesis de doctorado',
                            'code' => 'TD'
                        ],
                        [
                            'name' => 'Direcciones de trabajo de grado de maestría',
                            'code' => 'TM'
                        ],
                        [
                            'name' => 'Direcciones de trabajo de pregrado',
                            'code' => 'TP'
                        ],
                        [
                            'name' => 'Documentos de trabajo (working papers)',
                            'code' => 'WP'
                        ],
                        [
                            'name' => 'Eventos artísticos, de arquitectura o de diseño con componentes de apropiación',
                            'code' => 'ECA'
                        ],
                        [
                            'name' => 'Eventos científicos con componente de apropiación',
                            'code' => 'EC'
                        ],
                        [
                            'name' => 'Guía de manejo clínico forense',
                            'code' => 'GMCF'
                        ],
                        [
                            'name' => 'Guía de práctica clínica',
                            'code' => 'RNPC'
                        ],
                        [
                            'name' => 'Informes finales de investigación',
                            'code' => 'IFI'
                        ],
                        [
                            'name' => 'Libros de creación (Piloto)',
                            'code' => 'LIB_CRE'
                        ],
                        [
                            'name' => 'Libros de divulgación de investigación y/o compilación de divulgación',
                            'code' => 'LIB_DIV'
                        ],
                        [
                            'name' => 'Libros de formación',
                            'code' => 'LIB_FOR'
                        ],
                        [
                            'name' => 'Libros resultados de investigación',
                            'code' => 'LIB'
                        ],
                        [
                            'name' => 'Manuales y guías especializadas',
                            'code' => 'MAN_GUI'
                        ],
                        [
                            'name' => 'Manuales y modelos de atención diferencial a víctimas',
                            'code' => 'MADV'
                        ],
                        [
                            'name' => 'Norma técnica',
                            'code' => 'RNT'
                        ],
                        [
                            'name' => 'Normatividad del espectro radioeléctrico',
                            'code' => 'RNR'
                        ],
                        [
                            'name' => 'Notas científicas',
                            'code' => 'N'
                        ],
                        [
                            'name' => 'Productos resultados de la creación o investigación – creación.',
                            'code' => 'AAD'
                        ],
                        [
                            'name' => 'Protocolos de atención a usuarios/víctimas (pacientes)',
                            'code' => 'PAU'
                        ],
                        [
                            'name' => 'Protocolos de vigilancia epidemiológica',
                            'code' => 'PVE'
                        ],
                        [
                            'name' => 'Proyectos de Ley',
                            'code' => 'RNPL'
                        ],
                        [
                            'name' => 'Publicaciones editoriales no especializadas',
                            'code' => 'PEE'
                        ],
                        [
                            'name' => 'Regulaciones, normas, reglamentos o legislaciones',
                            'code' => 'RNL'
                        ],
                        [
                            'name' => 'Software',
                            'code' => 'SF'
                        ],
                        [
                            'name' => 'Talleres de creación',
                            'code' => 'TC'
                        ],
                    ]
                ]
            ]
        ],

        /** Category */
        [
            'name' => 'Derechos Conexos',

            /** Subcategories */
            'subcategories' => [
                [
                    'name' => 'Derechos Conexos',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Producción de Contenido Digital',
                            'code' => 'PCD'
                        ]
                    ]
                ]
            ]
        ],

        /** Category */
        [
            'name' => 'Otras Formas de Propiedad',

            /** Subcategories */
            'subcategories' => [
                [
                    'name' => 'Otras Formas',

                    /** Products */
                    'products' => [
                        [
                            'name' => 'Colecciones científicas',
                            'code' => 'CC'
                        ],
                        [
                            'name' => 'Nuevas razas animales',
                            'code' => 'VAA'
                        ],
                        [
                            'name' => 'Nuevas secuencias genéticas',
                            'code' => 'NSG'
                        ],
                        [
                            'name' => 'Nuevos registros científicos',
                            'code' => 'NRC'
                        ],
                        [
                            'name' => 'Poblaciones mejoradas de razas pecuarias',
                            'code' => 'VAB'
                        ],
                        [
                            'name' => 'Variedades vegetales',
                            'code' => 'W'
                        ],
                    ]
                ]
            ]
        ]
    ]

];
