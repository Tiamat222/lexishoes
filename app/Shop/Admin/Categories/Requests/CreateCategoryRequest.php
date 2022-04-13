<?php
namespace App\Shop\Admin\Categories\Requests;

use App\Shop\Admin\Categories\Services\DTO\CategoryCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
                'min:3',
                'unique:categories',
            ],
            'slug' => [
                'required', 
                'regex:/^[a-z0-9-]*$/', 
            ],
            'category_image' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
            ]
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
            'name.required' => __('admin-categories.category-name-required'),
            'name.min' => __('admin-categories.category-name-min'),
            'name.unique' => __('admin-categories.category-name-unique'),
            'slug.required' => __('admin-categories.category-slug-required'),
            'slug.regex' => __('admin-categories.category-slug-regex'),
            'category_image.image' => __('admin-categories.category-image-file'),
            'category_image.mimes' => __('admin-categories.category-image-mimes')
        ]; 
    }
    
    /**
     * Category create DTO
     *
     * @return CategoryCreateDto
     */
    public function data(): CategoryCreateDto
    {
        return new CategoryCreateDto([
            'is_active' => $this->input('is_active'), 
            'name' => $this->input('name'), 
            'slug' => $this->input('slug'), 
            'description' => $this->input('description'), 
            'category_image' => $this->file('category_image'), 
            'meta_title' => $this->input('meta_title'), 
            'meta_description' => $this->input('meta_description'), 
            'meta_keywords' => $this->input('meta_keywords'),
            'category_id' => $this->input('category-id')
        ]);
    }
}