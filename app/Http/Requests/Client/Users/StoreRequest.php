<?php

namespace App\Http\Requests\Client\Users;

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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:tenant.users'],
            'password' => ['required', 'string', 'min:5'],
            'repeat_password' => ['same:password'],
            'role_id' => ['required', 'exists:tenant.roles,id']
        ];
    }
}
