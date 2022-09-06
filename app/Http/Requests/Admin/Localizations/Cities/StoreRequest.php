<?php

namespace App\Http\Requests\Admin\Localizations\Cities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'state_id' => ['required', 'exists:mysql.states,id'],
            'name' => ['required', Rule::unique('mysql.cities', 'name')->where(function ($query) {
                return $query->where('state_id', $this->get('state_id'));
            })]
        ];
    }
}
