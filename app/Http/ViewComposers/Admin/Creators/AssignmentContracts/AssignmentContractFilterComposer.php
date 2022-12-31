<?php

namespace App\Http\ViewComposers\Admin\Creators\AssignmentContracts;

use Illuminate\View\View;

class AssignmentContractFilterComposer
{

    public function compose(View $view)
    {
        $types = [['id' => 2, 'name' => __('pages.admin.creators.assignment_contracts.options.external')], ['id' => 1, 'name' => __('pages.admin.creators.assignment_contracts.options.internal')]];

        $view->with(compact('types'));
    }
}
