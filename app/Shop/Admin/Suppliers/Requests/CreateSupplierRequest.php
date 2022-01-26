<?php
namespace App\Shop\Admin\Suppliers\Requests;

use App\Shop\Admin\Suppliers\Services\DTO\SupplierCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
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
                'unique:suppliers',
                'min:2'
            ],
            'description' => [
                'max:300'
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
            'name.required' => __('admin-suppliers.supplier-name-required'),
            'name.unique' => __('admin-suppliers.supplier-name-unique'),
            'name.min' => __('admin-suppliers.supplier-name-min'),
            'description.max' => __('admin-suppliers.supplier-description-max'),
        ]; 
    }
    
    /**
     * Supplier create DTO
     *
     * @return SupplierCreateDto
     */
    public function data(): SupplierCreateDto
    {
        return new SupplierCreateDto([
            'name' => $this->input('name'),
            'description' => $this->input('description'),
        ]);
    }
}

