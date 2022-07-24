<?php

namespace App\Http\Requests\Admin\Localizations\States;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'country_id' => ['required', 'exists:mysql.countries,id'],
            'name' => ['required', Rule::unique('mysql.states', 'name')->where(function ($query) {
                return $query->where('country_id', $this->get('country_id'));
            })->ignore($this->state)]
        ];
    }
}
