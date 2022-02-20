<?php
namespace App\Shop\Admin\Attributes\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $attributeId = request()->get('id');
        return [
            'name' => [
                'required',
                'min:2',
                Rule::unique('attributes')->ignore($attributeId),
            ],
        ];
    }

    /**
     * Validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('admin-attributes.attribute-name-required'),
            'name.min' => __('admin-attributes.attribute-name-min')
        ]; 
    }
}

