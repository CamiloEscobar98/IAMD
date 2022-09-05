<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Traits\Client\ViewComposers\AdminRoutes;
use App\Traits\Client\ViewComposers\ClientRoutes;

class ComposerServiceProvider extends ServiceProvider
{
    use AdminRoutes, ClientRoutes;

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
        $this->getAdminViewComposers();
        $this->getClientViewComposers();
    }
}
