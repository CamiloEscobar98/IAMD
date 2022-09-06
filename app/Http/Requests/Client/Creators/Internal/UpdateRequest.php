<?php

namespace App\Http\Requests\Client\Creators\Internal;

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
            /** Creator */
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email', 'unique:tenant.creators'],
            'phone' => ['nullable'],

            /** Creator Document */
            'document_type_id' => ['required', 'exists:mysql.document_types,id'],
            'expedition_place_id' => ['required', 'exists:mysql.cities,id'],
            'document' => ['required', 'unique:tenant.creator_documents,document'],

            /** Creator Internal */
            'linkage_type_id' => ['required', 'exists:mysql.linkage_types,id'],
            'assignment_contract_id' => ['required', 'exists:mysql.assignment_contracts,id'],
        ];
    }
}
