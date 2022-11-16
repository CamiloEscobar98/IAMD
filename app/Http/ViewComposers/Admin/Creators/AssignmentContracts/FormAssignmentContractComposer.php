<?php

namespace App\Http\ViewComposers\Admin\Creators\AssignmentContracts;

use Illuminate\View\View;

class FormAssignmentContractComposer
{

    public function compose(View $view)
    {
        $types = collect([
            [
                'id' => 0, 'name' => __('pages.admin.creators.assigment_contracts.options.external'),
            ],
            [
                'id' => 1, 'name' => __('pages.admin.creators.assigment_contracts.options.internal')
            ]
        ])->pluck('name', 'id')->prepend('---Selecciona si el tipo de contrato es para un creador interno o externo', -1);

        $view->with(compact('types'));
    }
}
