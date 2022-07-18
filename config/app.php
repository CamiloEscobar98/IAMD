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

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

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
    'intangibleAssetCategoryLevels' => [

        /** Level 1 */
        [
            'name' => 'Propiedad Industrial',

            /** Level 2 */
            'level2' => [
                [
                    'name' => 'Diseño Industrial',

                    /** Level 3 */
                    'level3' => ['Diseños Industriales']
                ],

                [
                    'name' => 'Esquemas de Trazado de Circuito Integrado',

                    /** Level 3 */
                    'level3' => ['Esquemas de trazado de circuito integrado']
                ],
                [
                    'name' => 'Nuevas Creaciones e Innovaciones',

                    /** Level 3 */
                    'level3' => [
                        'Patente oncedida',
                        'Patente concedida y explotada',
                        'Patente en trámite',
                    ]
                ],
                [
                    'name' => 'Prototipos Industriales',

                    /** Level 3 */
                    'level3' => ['Prototipos Industriales']
                ],
                [
                    'name' => 'Secretos Industriales',

                    /** Level 3 */
                    'level3' => [
                        'Innovaciones generadas en la gestión empresarial',
                        'Secreto empresarial'
                    ]
                ],
                [
                    'name' => 'Signos Distintivos',

                    /** Level 3 */
                    'level3' => [
                        'Signos Distintivos'
                    ],
                ],
            ]
        ],

        /** Level 1 */
        [
            'name' => 'Derechos de Autor',

            /** Level 2 */
            'level2' => [
                [
                    'name' => 'Derechos de Autor',

                    /** Level 3 */
                    'level3' => [
                        'Acuerdo de Ley',
                        'Artículos de investigación',
                        'Boletines divulgativos de resultado de investigación',
                        'Capítulos en libro resultado de investigación',
                        'Direcciones de tesis de doctorado',
                        'Direcciones de trabajo de grado de maestría',
                        'Direcciones de trabajo de pregrado',
                        'Documentos de trabajo (working papers)',
                        'Eventos artísticos, de arquitectura o de diseño con componentes de apropiación',
                        'Eventos científicos con componente de apropiación',
                        'Guía de manejo clínico forense',
                        'Guía de práctica clínica',
                        'Informes finales de investigación',
                        'Libros de creación (Piloto)',
                        'Libros de divulgación de investigación y/o compilación de divulgación',
                        'Libros de formación',
                        'Libros resultados de investigación',
                        'Manuales y guías especializadas',
                        'Manuales y modelos de atención diferencial a víctimas',
                        'Norma técnica',
                        'Normatividad del espectro radioeléctrico',
                        'Notas científicas',
                        'Productos resultados de la creación o investigación – creación.',
                        'Protocolos de atención a usuarios/víctimas (pacientes)',
                        'Protocolos de vigilancia epidemiológica',
                        'Proyectos de Ley',
                        'Publicaciones editoriales no especializadas',
                        'Regulaciones, normas, reglamentos o legislaciones',
                        'Softwares',
                        'Talleres de creación',
                    ]
                ]
            ]
        ],

        /** Level 1 */
        [
            'name' => 'Derechos Conexos',

            /** Level 2 */
            'level2' => [
                [
                    'name' => 'Derechos Conexos',

                    /** Level 3 */
                    'level3' => [
                        'Producción de Contenido Digital'
                    ]
                ]
            ]
        ],

        /** Level 1 */
        [
            'name' => 'Otras Formas de Propiedad',

            /** Level 2 */
            'level2' => [
                [
                    'name' => 'Otras Formas',

                    /** Level 3 */
                    'level3' => [
                        'Colecciones científicas',
                        'Nuevas razas animales',
                        'Nuevas secuencias genéticas',
                        'Nuevos registros científicos',
                        'Poblaciones mejoradas de razas pecuarias',
                        'Variedades vegetales',
                    ]
                ]
            ]
        ]
    ]

];
