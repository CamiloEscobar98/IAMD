<?php

namespace App\Http\Requests\Client\Projects;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'research_unit_id' => ['required', 'exists:tenant.research_units,id'],
            'director_id' => ['required', 'exists:tenant.creators,id'],
            'name' => ['required', 'unique:tenant.research_units'],
            'description' => ['nullable'],

            'financing_type_id' => ['required', 'exists:tenant.financing_types,id'],
            'project_contract_type_id' => ['required', 'exists:tenant.project_contract_types,id'],
            'contract' => ['required', 'string', 'unique:tenant.projects'],
            'date' => ['required', 'date']
        ];
    }
}
