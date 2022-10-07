<?php

namespace App\Traits\Client\ViewComposers;

use App\Http\ViewComposers\Admin\IntellectualPropertyRights\Products\IntellectualPropertyRightProductFilterComposer;
use Illuminate\Support\Facades\View;

use App\Http\ViewComposers\Admin\Localization\States\StateFilterComposer;
use App\Http\ViewComposers\Admin\Localization\States\StateFormComposer;
use App\Http\ViewComposers\Admin\Localization\States\StateShowComposer;

use App\Http\ViewComposers\Admin\Localization\Cities\CityFilterComposer;
use App\Http\ViewComposers\Admin\Localization\Cities\CityFormComposer;

use App\Http\ViewComposers\Admin\IntellectualPropertyRights\Subcategories\IntellectualPropertyRightSubcategoryFormComposer;
use App\Http\ViewComposers\Admin\IntellectualPropertyRights\Products\IntellectualPropertyRightProductFormComposer;

/**
 * 
 */
trait AdminRoutes
{
    /**
     * Get ViewComposers for Clients
     * 
     * @return void
     */
    protected function getAdminViewComposers()
    {

        /** States */
        View::composer('admin.pages.localization.states.components.filters', StateFilterComposer::class);
        View::composer('admin.pages.localization.states.components.form', StateFormComposer::class);
        View::composer('admin.pages.localization.states.show', StateShowComposer::class);

        /** Cities */
        View::composer('admin.pages.localization.cities.components.filters', CityFilterComposer::class);
        View::composer('admin.pages.localization.cities.components.form', CityFormComposer::class);

        /** Intellectual Property Rights */
        // Categories

        // Subcategories
        View::composer('admin.pages.intellectual_property_rights.subcategories.components.form', IntellectualPropertyRightSubcategoryFormComposer::class);

        // Products
        View::composer('admin.pages.intellectual_property_rights.products.components.filters', IntellectualPropertyRightProductFilterComposer::class);
        View::composer('admin.pages.intellectual_property_rights.products.components.form', IntellectualPropertyRightProductFormComposer::class);
    }
}
