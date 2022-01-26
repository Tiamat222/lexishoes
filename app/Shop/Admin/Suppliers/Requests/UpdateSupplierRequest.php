<?php
namespace App\Shop\Admin\Suppliers\Requests;

use App\Shop\Admin\Suppliers\Services\DTO\SupplierUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules(): array
    {
        $supplierId = request()->get('id');
        return [
            'name' => [
                'required',
                Rule::unique('suppliers')->ignore($supplierId),
                'min:2'
            ],
            'description' => [
                'max:300'
            ],
        ];
    }

    /**
     * Validation messages
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
     * Update supplier DTO
     *
     * @return SupplierUpdateDto
     */
    public function data(): SupplierUpdateDto
    {
        return new SupplierUpdateDto([
            'id' => $this->input('id'),
            'name' => $this->input('name'),
            'description' => $this->input('description'),
        ]);
    }
}

