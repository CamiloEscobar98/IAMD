<?php

namespace App\Http\Requests\Admin\Creator\ExternalOrganizations;

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
            'nit' => ['required', 'unique:mysql.external_organizations'],
            'name' => ['required', 'unique:mysql.external_organizations'],
            'email' => ['required', 'unique:mysql.external_organizations'],
            'telephone' => ['required', 'unique:mysql.external_organizations'],
            'address' => ['required', 'unique:mysql.external_organizations'],
        ];
    }
}
