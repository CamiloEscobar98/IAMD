<?php

namespace App\Http\Requests\Client\ResearchUnits;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'administrative_unit_id' => ['required', 'exists:tenant.administrative_units,id'],
            'academic_department_id' => ['required', 'exists:tenant.academic_departments,id'],
            'research_unit_category_id' => ['required', 'exists:tenant.research_unit_categories,id'],
            'director_id' => ['required', 'exists:tenant.creators,id'],
            'inventory_manager_id' => ['required', 'exists:tenant.creators,id'],
            'name' => ['required', 'unique:tenant.research_units,name,' . $this->research_unit],
            'code' => ['required', 'min:2', 'max:4', 'unique:tenant.research_units,code,' . $this->research_unit],
            'description' => ['nullable']
        ];
    }
}
