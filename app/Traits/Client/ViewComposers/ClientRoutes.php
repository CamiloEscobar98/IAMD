<?php

namespace App\Traits\Client\ViewComposers;

use Illuminate\Support\Facades\View;

use App\Http\ViewComposers\ClientComposer;

use App\Http\ViewComposers\Client\ResearchUnits\ResearchUnitFilterComposer;
use App\Http\ViewComposers\Client\ResearchUnits\CreateResearchUnitComposer;

use App\Http\ViewComposers\Client\Projects\ProjectFilterComposer;
use App\Http\ViewComposers\Client\Projects\CreateProjectComposer;

use App\Http\ViewComposers\Client\Creators\Internal\CreatorInternalFilterComposer;
use App\Http\ViewComposers\Client\Creators\Internal\CreateCreatorInternalComposer;

use App\Http\ViewComposers\Client\Creators\External\CreatorExternalFilterComposer;
use App\Http\ViewComposers\Client\Creators\External\CreateCreatorExternalComposer;

use App\Http\ViewComposers\Client\IntangibleAssets\IntangibleAssetFilterComposer;
use App\Http\ViewComposers\Client\IntangibleAssets\CreateIntangibleAssetComposer;
use App\Http\ViewComposers\Client\IntangibleAssets\ShowIntangibleAssetComposer;
use App\Http\ViewComposers\Client\IntangibleAssets\StrategyIntangibleAssetComposer;

trait ClientRoutes
{
    /**
     * Get ViewComposers for Clients
     * 
     * @return void
     */
    protected function getClientViewComposers()
    {
        $views = [];

        $views = array_merge(
            $views,
            $this->getMainRoutes(),
            $this->getAdministrativeUnitRoutes(),
            $this->getResearchUnitRoutes(),
            $this->getProjectRoutes(),
            $this->getCreatorRoutes(),
            $this->getIntangibleAssetRoutes()
        );

        View::composer($views, ClientComposer::class);

        /** Research Units */
        View::composer('client.pages.research_units.components.filters', ResearchUnitFilterComposer::class);
        View::composer('client.pages.research_units.components.form', CreateResearchUnitComposer::class);

        /** Projects */
        View::composer('client.pages.projects.components.filters', ProjectFilterComposer::class);
        View::composer('client.pages.projects.components.form', CreateProjectComposer::class);

        /** Creators */

        /** Internal */
        View::composer('client.pages.creators.internal.components.filters', CreatorInternalFilterComposer::class);
        View::composer('client.pages.creators.internal.components.form', CreateCreatorInternalComposer::class);

        /** External */
        View::composer('client.pages.creators.external.components.filters', CreatorExternalFilterComposer::class);
        View::composer('client.pages.creators.external.components.form', CreateCreatorExternalComposer::class);

        /** Intangible Assets */
        View::composer('client.pages.intangible_assets.components.filters', IntangibleAssetFilterComposer::class);
        View::composer('client.pages.intangible_assets.components.form', CreateIntangibleAssetComposer::class);
        View::composer('client.pages.intangible_assets.components.phases', ShowIntangibleAssetComposer::class);
        View::composer('client.pages.intangible_assets.strategies', StrategyIntangibleAssetComposer::class);
    }

    /**
     * get AdministrativeUnitsRoutes
     * 
     * @return array
     */
    protected function getMainRoutes(): array
    {
        return [
            'client.layout.app',
            'client.pages.auth.login',
        ];
    }

    /**
     * get Administrative Unit Routes
     * 
     * @return array
     */
    protected function getAdministrativeUnitRoutes(): array
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

    /**
     * get Research Unit Routes
     * 
     * @return array
     */
    protected function getResearchUnitRoutes(): array
    {
        return [
            'client.pages.research_units.index',
            'client.pages.research_units.create',
            'client.pages.research_units.show',
            'client.pages.research_units.edit',

            'client.pages.research_units.components.filters',
            'client.pages.research_units.components.table',
        ];
    }

    /**
     * get Project Routes
     * 
     * @return array
     */
    protected function getProjectRoutes(): array
    {
        return [
            'client.pages.projects.index',
            'client.pages.projects.create',
            'client.pages.projects.show',
            'client.pages.projects.edit',

            'client.pages.projects.components.filters',
            'client.pages.projects.components.table',
        ];
    }

    /**
     * get Creator Routes
     * 
     * @return array
     */
    protected function getCreatorRoutes(): array
    {
        return [
            'client.pages.creators.internal.index',
            'client.pages.creators.internal.create',
            'client.pages.creators.internal.show',
            'client.pages.creators.internal.edit',

            'client.pages.creators.internal.components.filters',
            'client.pages.creators.internal.components.table',

            'client.pages.creators.external.index',
            'client.pages.creators.external.create',
            'client.pages.creators.external.show',
            'client.pages.creators.external.edit',

            'client.pages.creators.external.components.filters',
            'client.pages.creators.external.components.table',
        ];
    }

    /**
     * get Intangible Assets Routes
     * 
     * @return array
     */
    protected function getIntangibleAssetRoutes(): array
    {
        return [
            'client.pages.intangible_assets.index',
            'client.pages.intangible_assets.create',
            'client.pages.intangible_assets.show',
            'client.pages.intangible_assets.edit',
            'client.pages.intangible_assets.strategies',

            'client.pages.intangible_assets.components.filters',
            'client.pages.intangible_assets.components.table',
            'client.pages.intangible_assets.components.form',
        ];
    }
}
