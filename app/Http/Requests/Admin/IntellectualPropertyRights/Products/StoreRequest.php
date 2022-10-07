<?php

namespace App\Http\Requests\Admin\IntellectualPropertyRights\Products;

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
            'intellectual_property_right_category_id' => ['required', 'exists:intellectual_property_right_categories,id'],
            'intellectual_property_right_subcategory_id' => ['required', 'exists:intellectual_property_right_subcategories,id'],
            'name' => ['required', 'unique:mysql.intellectual_property_right_products'],
        ];
    }
}
