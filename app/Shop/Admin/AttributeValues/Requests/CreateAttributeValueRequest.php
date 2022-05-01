<?php
namespace App\Shop\Admin\AttributeValues\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttributeValueRequest extends FormRequest
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
        $attributeType = request()->get('attribute-type');
        return [
            'attribute' => [
                'required',
                ($attributeType == 'Цвет верха' || $attributeType == 'Цвет подошвы') ? 'regex:/^[#a-zA-Z0-9]*$/' : ''
            ],
            'name' => [
                'required',
                'min:2',
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
            'attribute.regex' => __('Допустимый формат цвета - HEX (#FFFFFF)')
        ]; 
    }
}

