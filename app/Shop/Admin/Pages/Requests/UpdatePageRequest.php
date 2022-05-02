<?php

namespace App\Shop\Admin\Pages\Requests;

use App\Shop\Admin\Pages\Services\DTO\PageUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends FormRequest
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
        $pageId = request()->get('id');
        return [
            'title' => [
                'required',
                'min:2',
                Rule::unique('pages')->ignore($pageId),
            ],
            'slug' => [
                'required',
                'min:2',
                Rule::unique('pages')->ignore($pageId),
            ],
            'text' => [
                'nullable',
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
            'title.required' => __('admin-pages.pages-title-required'),
            'title.min' => __('admin-pages.pages-title-min'),
            'title.unique' => __('admin-pages.pages-title-unique'),
            'slug.required' => __('admin-pages.pages-slug-required'),
            'slug.min' => __('admin-pages.pages-slug-min'),
            'slug.unique' => __('admin-pages.pages-slug-unique'),
        ]; 
    }

    /**
     * Page update DTO
     *
     * @return PageUpdateDto
     */
    public function data(): PageUpdateDto
    {
        return new PageUpdateDto([
            'id' => $this->input('id'),
            'title' => $this->input('title'),
            'status' => $this->input('status'),
            'slug' => $this->input('slug'),
            'text' => $this->input('text'),
            'metaTitle' => $this->input('meta_title'),
            'metaKeywords' => $this->input('meta_keywords'),
            'metaDescription' => $this->input('meta_description')
        ]);
    }
}