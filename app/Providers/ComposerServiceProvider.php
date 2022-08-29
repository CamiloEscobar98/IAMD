<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Traits\Client\ViewComposers\ClientRoutes;

class ComposerServiceProvider extends ServiceProvider
{
    use ClientRoutes;
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

        $views = array_merge($views, $this->getMainRoutes(), $this->getAdministrativeUnitRoutes(), $this->getResearchUnitRoutes());

        View::composer($views, 'App\Http\ViewComposers\ClientComposer');

        View::composer(['client.pages.research_units.components.filters', 'client.pages.research_units.components.form'], 'App\Http\ViewComposers\Client\ResearchUnitViewComposer');
    }
}
