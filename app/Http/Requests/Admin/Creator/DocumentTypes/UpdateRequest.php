<?php

namespace App\Http\Requests\Admin\Creator\DocumentTypes;

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
            'name' => ['required', 'unique:mysql.document_types,name,' . $this->document_type],
            'slug' => ['required', 'unique:mysql.document_types,slug,' . $this->document_type],
        ];
    }
}
