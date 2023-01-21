<?php

namespace App\Http\Requests\Client\IntangibleAssets;

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
            'project_id' => ['required', 'exists:tenant.projects,id'],
            'research_unit_id' => ['required'],
            'name' => ['required', 'unique:tenant.intangible_assets'],
            'date' => ['required', 'date'],
            'localization' => ['required'],
            'localization_code' => ['nullable']
        ];
    }
}
