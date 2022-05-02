<?php

namespace App\Shop\Admin\Pages\Services;

use App\Shop\Admin\Pages\Exceptions\CreatePageErrorException;
use App\Shop\Admin\Pages\Page;
use App\Shop\Admin\Pages\Services\DTO\PageCreateDto;
use App\Shop\Core\Admin\Base\Services\BaseService;
use Illuminate\Database\QueryException;

class PageService extends BaseService
{    
    /**
     * PageService constructor
     *
     * @param  Page $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * Store new page
     *
     * @param  PageCreateDto $dataToStore
     * 
     * @throws CreatePageErrorException
     * @return bool
     */
    public function store(PageCreateDto $dataToStore): bool
    {
        try {
            $page = new Page();
            $page->title = $dataToStore->title;
            $page->slug = $dataToStore->slug;
            $page->text = $dataToStore->text;
            $page->meta_title = $dataToStore->metaTitle;
            $page->meta_keywords = $dataToStore->metaKeywords;
            $page->meta_description = $dataToStore->metaDescription;
            $page->save();
            return true;
        } catch(QueryException $e) {
            throw new CreatePageErrorException($e->getMessage());
        }
    }
}