<?php
namespace App\Shop\Admin\Categories\Services\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\UploadedFile;

final class CategoryUpdateDto extends DataTransferObject
{
    /**
     * Category id
     *
     * @var string
     */
    public int $id;

    /**
     * Category status
     *
     * @var string
     */
    public string $is_active;

    /**
     * Category name
     *
     * @var string
     */
    public string $name;

    /**
     * Category slug
     *
     * @var string
     */
    public string $slug;

    /**
     * Category description
     *
     * @var string|null
     */
    public string|null $description;

    /**
     * Category cover image
     *
     * @var
     */
    public UploadedFile|string|null $category_image;

    /**
     * Category meta-title
     *
     * @var string|null
     */
    public string|null $meta_title;

    /**
     * Category meta-description
     *
     * @var string|null
     */
    public string|null $meta_description;

    /**
     * Category meta-keywords
     *
     * @var string|null
     */
    public string|null $meta_keywords;

    /**
     * Parent category
     *
     * @var int|null
     */
    public int|null $category_id;
}