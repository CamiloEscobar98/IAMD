<?php

namespace App\Http\Requests\Client\ProjectContractTypes;

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
            'name' => ['required', 'string', 'unique:tenant.project_contract_types,name,' . $this->project_contract_type],
            'code' => ['required', 'string', 'unique:tenant.project_contract_types,code,' . $this->project_contract_type]
        ];
    }
}
