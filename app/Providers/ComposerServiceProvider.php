<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $views = [];

        $views = array_merge($views, $this->getMainRoutes(), $this->getAdministrativeUnitRoutes());

        View::composer($views, 'App\Http\ViewComposers\ClientComposer');
    }

    /**
     * get AdministrativeUnitsRoutes
     * 
     * @return array
     */
    private function getMainRoutes(): array
    {
        return [
            'client.layout.app',
            'client.pages.auth.login',
        ];
    }

    /**
     * get AdministrativeUnitsRoutes
     * 
     * @return array
     */
    private function getAdministrativeUnitRoutes(): array
    {
        return [
            'client.pages.administrative_units.index',
            'client.pages.administrative_units.create',
            'client.pages.administrative_units.show',
            'client.pages.administrative_units.edit',

            'client.pages.administrative_units.components.filters',
            'client.pages.administrative_units.components.table',
        ];
    }
}
