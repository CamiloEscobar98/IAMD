<?php

namespace App\Http\Requests\Admin\ExternalOrganizations;

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
            'nit' => ['required', 'unique:mysql.external_organizations,nit,' . $this->external_organization],
            'name' => ['required', 'unique:mysql.external_organizations,name,' . $this->external_organization],
            'email' => ['required', 'email'],
            'telephone' => ['required'],
            'address' => ['required'],
        ];
    }
}
