<?php

namespace App\Shop\Front\Callback\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCallbackRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'regex:/^[A-Za-zА-яЁё0-9-\s]+$/',
                'min:1'
            ],
            'phone' => [
                'required',
                'regex:/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/',
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
            'name.required' => __('front-callback.callback-name-required'),
            'name.regex' => __('front-callback.callback-name-regex'),
            'name.min' => __('front-callback.callback-name-min'),
            'phone.required' => __('front-callback.callback-phone-required'),
            'phone.regex' => __('front-callback.callback-phone-regex'),
        ]; 
    }
}