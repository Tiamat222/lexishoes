<?php

namespace App\Shop\Admin\Pages\Services\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class PageUpdateDto extends DataTransferObject
{
    /**
     * Page id
     *
     * @var int
     */
    public string $id;

    /**
     * Page status
     *
     * @var null|string
     */
    public ?string $status;

    /**
     * Page title
     *
     * @var string
     */
    public string $title;

    /**
     * Page slug
     *
     * @var string
     */
    public string $slug;

    /**
     * Page text
     *
     * @var null|string
     */
    public ?string $text;

    /**
     * Page meta title
     *
     * @var null|string
     */
    public ?string $metaTitle;

    /**
     * Page meta keywords
     *
     * @var null|string
     */
    public ?string $metaKeywords;

    /**
     * Page meta description
     *
     * @var null|string
     */
    public ?string $metaDescription;
}
