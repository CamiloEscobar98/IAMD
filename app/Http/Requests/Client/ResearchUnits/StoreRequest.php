<?php

namespace App\Http\Requests\Client\ResearchUnits;

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
            'administrative_unit_id' => ['required', 'exists:tenant.research_units'],
            'research_unit_category_id' => ['required', 'exists:tenant.research_units'],
            'director_id' => ['required', 'exists:tenant.research_units'],
            'inventory_manager_id' => ['required', 'exists:tenant.research_units'],
            'name' => ['required', 'unique:tenant.research_units'],
            'code' => ['required', 'unique:tenant.research_units'],
            'description' => ['nullable']
        ];
    }
}
