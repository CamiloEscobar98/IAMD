<?php

namespace App\Traits\Client\ViewComposers;

trait ClientRoutes
{
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
     * get Project Routes
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
}
