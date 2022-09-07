<?php

namespace App\Http\Requests\Client\Creators\External;

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
            /** Creator */
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email', Rule::unique('tenant.creators', 'email')->ignore($this->external)],
            'phone' => ['nullable'],

            /** Creator Document */
            'document_type_id' => ['required', 'exists:mysql.document_types,id'],
            'expedition_place_id' => ['required', 'exists:mysql.cities,id'],
            'document' => ['required', Rule::unique('tenant.creator_documents', 'document')->ignore($this->external, 'creator_id')],

            /** Creator External */
            'external_organization_id' => ['required', 'exists:mysql.external_organizations,id'],
            'assignment_contract_id' => ['required', 'exists:mysql.assignment_contracts,id'],
        ];
    }
}
