<?php

namespace App\Http\Requests\Admin\Localizations\States;

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
            'name' => ['required', 'unique:mysql.states,id' . $this->id]
        ];
    }
}
