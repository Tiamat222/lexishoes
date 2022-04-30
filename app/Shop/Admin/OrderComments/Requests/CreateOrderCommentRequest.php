<?php

namespace App\Shop\Admin\OrderComments\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderCommentRequest extends FormRequest
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
            'comment' => [
                'required',
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
            'comment.required' => __('admin-orders.order-comment-required'),
        ]; 
    }
}