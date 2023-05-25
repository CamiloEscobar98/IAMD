<?php

namespace App\Traits\Client\ViewComposers;

use Illuminate\Support\Facades\View;

use App\Http\ViewComposers\Client\DashboardComposer;

use App\Http\ViewComposers\ClientComposer;
use App\Http\ViewComposers\Client\NotificationComposer;

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
use App\Http\ViewComposers\Client\Permissions\CreatePermissionComposer;
use App\Http\ViewComposers\Client\Permissions\FilterPermissionComposer;
use App\Http\ViewComposers\Client\Reports\Custom\CustomReportFilterComposer;

use App\Http\ViewComposers\Client\Roles\FormRoleComposer;
use App\Http\ViewComposers\Client\Roles\ShowRoleComposer;

use App\Http\ViewComposers\Client\Users\UserFormComposer;


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
            $this->getAcademicDepartmentRoutes(),
            $this->getResearchUnitRoutes(),
            $this->getProjectRoutes(),
            $this->getCreatorRoutes(),
            $this->getIntangibleAssetRoutes(),
            $this->getUserRoutes(),
            $this->getRoleRoutes(),
            $this->getPermissionRoutes(),
            $this->getPriorityToolRoutes(),
            $this->getStrategiesRoute(),
            $this->getStrategyCategoriesRoute(),
            $this->getFinancingTypeRoutes(),
            $this->getSecretProtectionMeasureRoutes(),
            $this->getProjectContractTypeRoutes(),
            $this->getUserReportRoutes(),
            $this->getNotificationRoutes()
        );

        View::composer($views, ClientComposer::class);

        /** Notifications for Users */
        View::composer('client.partials.navbar', NotificationComposer::class);

        /** Dashboard */
        View::composer('client.pages.home', DashboardComposer::class);

        /** Research Units */
        View::composer('client.pages.research_units.components.filters', ResearchUnitFilterComposer::class);
        View::composer('client.pages.research_units.components.form', CreateResearchUnitComposer::class);

        /** Projects */
        View::composer('client.pages.projects.components.filters', ProjectFilterComposer::class);
        View::composer(['client.pages.projects.components.form', 'client.pages.projects.edit'], CreateProjectComposer::class);

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

        /** Users */
        View::composer('client.pages.users.components.form', UserFormComposer::class);

        /** Roles */
        View::composer('client.pages.roles.components.form', FormRoleComposer::class);
        View::composer('client.pages.roles.show', ShowRoleComposer::class);

        /** Permissions */
        View::composer('client.pages.permissions.components.filters', FilterPermissionComposer::class);
        View::composer('client.pages.permissions.components.form', CreatePermissionComposer::class);

        /** Custom Reports */
        View::composer('client.pages.reports.custom.index', CustomReportFilterComposer::class);
    }

    /**
     * get AdministrativeUnitsRoutes
     * 
     * @return array<int,string>
     */
    protected function getMainRoutes(): array
    {
        return [
            'client.layout.app',
            'client.pages.auth.login',
            'client.pages.auth.reset_password',
            'client.pages.home',
        ];
    }

    /**
     * get Administrative Unit Routes
     * 
     * @return array<int,string>
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
     * get Administrative Unit Routes
     * 
     * @return array<int,string>
     */
    protected function getAcademicDepartmentRoutes(): array
    {
        return [
            'client.pages.academic_departments.index',
            'client.pages.academic_departments.create',
            'client.pages.academic_departments.show',
            'client.pages.academic_departments.edit',

            'client.pages.academic_departments.components.filters',
            'client.pages.academic_departments.components.table',
        ];
    }

    /**
     * get Research Unit Routes
     * 
     * @return array<int,string>
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
     * @return array<int,string>
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
            'client.pages.projects.components.form'
        ];
    }

    /**
     * get Creator Routes
     * 
     * @return array<int,string>
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
     * @return array<int,string>
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

    /**
     * get Users Routes
     * 
     * @return array<int,string>
     */
    protected function getUserRoutes(): array
    {
        return [
            'client.pages.users.index',
            'client.pages.users.create',
            'client.pages.users.show',
            'client.pages.users.edit',

            'client.pages.users.components.filters',
            'client.pages.users.components.table',
        ];
    }

    /**
     * get Roles Routes
     * 
     * @return array<int,string>
     */
    protected function getRoleRoutes(): array
    {
        return [
            'client.pages.roles.index',
            'client.pages.roles.create',
            'client.pages.roles.show',
            'client.pages.roles.edit',

            'client.pages.roles.components.filters',
            'client.pages.roles.components.table',
        ];
    }


    /**
     * get Roles Routes
     * 
     * @return array<int,string>
     */
    protected function getPermissionRoutes(): array
    {
        return [
            'client.pages.permissions.index',
            'client.pages.permissions.create',
            'client.pages.permissions.show',
            'client.pages.permissions.edit',

            'client.pages.permissions.components.filters',
            'client.pages.permissions.components.table',
        ];
    }

    /**
     * get Priority Tools Routes
     * 
     * @return array<int,string>
     */
    protected function getPriorityToolRoutes(): array
    {
        return [
            'client.pages.priority_tools.index',
            'client.pages.priority_tools.create',
            'client.pages.priority_tools.show',
            'client.pages.priority_tools.edit',

            'client.pages.priority_tools.components.filters',
            'client.pages.priority_tools.components.table',
        ];
    }

    /**
     * get Strategies Routes
     * 
     * @return array<int,string>
     */
    protected function getStrategiesRoute(): array
    {
        return [
            'client.pages.strategies.index',
            'client.pages.strategies.create',
            'client.pages.strategies.show',
            'client.pages.strategies.edit',

            'client.pages.strategies.components.filters',
            'client.pages.strategies.components.table',
        ];
    }

    /**
     * get Strategy Categories Routes
     * 
     * @return array<int,string>
     */
    protected function getStrategyCategoriesRoute(): array
    {
        return [
            'client.pages.strategy_categories.index',
            'client.pages.strategy_categories.create',
            'client.pages.strategy_categories.show',
            'client.pages.strategy_categories.edit',

            'client.pages.strategy_categories.components.filters',
            'client.pages.strategy_categories.components.table',
        ];
    }

    /**
     * get Financing Types Routes
     * 
     * @return array<int,string>
     */
    protected function getFinancingTypeRoutes(): array
    {
        return [
            'client.pages.financing_types.index',
            'client.pages.financing_types.create',
            'client.pages.financing_types.show',
            'client.pages.financing_types.edit',

            'client.pages.financing_types.components.filters',
            'client.pages.financing_types.components.table',
        ];
    }

    /**
     * get Financing Types Routes
     * 
     * @return array<int,string>
     */
    protected function getSecretProtectionMeasureRoutes(): array
    {
        return [
            'client.pages.secret_protection_measures.index',
            'client.pages.secret_protection_measures.create',
            'client.pages.secret_protection_measures.show',
            'client.pages.secret_protection_measures.edit',

            'client.pages.secret_protection_measures.components.filters',
            'client.pages.secret_protection_measures.components.table',
        ];
    }

    /**
     * get Financing Types Routes
     * 
     * @return array<int,string>
     */
    protected function getProjectContractTypeRoutes(): array
    {
        return [
            'client.pages.project_contract_types.index',
            'client.pages.project_contract_types.create',
            'client.pages.project_contract_types.show',
            'client.pages.project_contract_types.edit',

            'client.pages.project_contract_types.components.filters',
            'client.pages.project_contract_types.components.table',
        ];
    }

    /**
     * get Financing Types Routes
     * 
     * @return array<int,string>
     */
    protected function getUserReportRoutes(): array
    {
        return [
            'client.pages.users.reports.index',
            'client.pages.reports.custom.index'
        ];
    }

    /**
     * get Notification Routes
     * 
     * @return array<int,string>
     */
    public function getNotificationRoutes()
    {
        return [
            'client.pages.notifications.index',

            'client.pages.notifications.components.filters',
            'client.pages.notifications.components.table',
        ];
    }
}
