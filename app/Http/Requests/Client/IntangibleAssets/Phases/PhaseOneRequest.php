<?php

namespace App\Http\Requests\Client\IntangibleAssets\Phases;

use Illuminate\Foundation\Http\FormRequest;

class PhaseOneRequest extends FormRequest
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
            'name' => ['required', 'unique:tenant.intangible_assets'],
        ];
    }
}
