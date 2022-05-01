<?php
namespace App\Shop\Admin\AttributeValues\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttributeValueRequest extends FormRequest
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
        $attributeValueId = request()->get('attribute-value-id');
        return [
            'parent-attribute-id' => [
                'required',
            ],
            'value' => [
                'required',
                'min:2',
                Rule::unique('attributes_values')->ignore($attributeValueId),
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
            'name.required' => __('admin-attributes.value-name-required'),
            'name.min' => __('admin-attributes.value-name-min'),
            'attribute.required' => __('admin-attribute.value-attribute-required'),
            'attribute.regex' => __('admin-attribute.attribute-value-regex-hex')
        ]; 
    }
}

