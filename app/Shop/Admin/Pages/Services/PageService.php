<?php

namespace App\Shop\Admin\Pages\Services;

use App\Shop\Admin\Pages\Exceptions\CreatePageErrorException;
use App\Shop\Admin\Pages\Exceptions\UpdatePageErrorException;
use App\Shop\Admin\Pages\Page;
use App\Shop\Admin\Pages\Services\DTO\PageCreateDto;
use App\Shop\Admin\Pages\Services\DTO\PageUpdateDto;
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

    /**
     * Update page data
     *
     * @param  PageUpdateDto $dataToUpdate
     *
     * @throws UpdatePageErrorException
     * @return bool
     */
    public function update(PageUpdateDto $dataToUpdate): bool
    {
        try {
            $page = $this->getRecordById($dataToUpdate->id);
            if($dataToUpdate->status === 'on') {
                $page->status = 1;
            } else {
                $page->status = 0;
            }
            $page->title = $dataToUpdate->title;
            $page->slug = $dataToUpdate->slug;
            $page->text = $dataToUpdate->text;
            $page->meta_title = $dataToUpdate->metaTitle;
            $page->meta_keywords = $dataToUpdate->metaKeywords;
            $page->meta_description = $dataToUpdate->metaDescription;
            $page->update();
            return true;
        } catch(QueryException $e) {
            throw new UpdatePageErrorException($e->getMessage());
        }
    }
}