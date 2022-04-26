<?php

namespace App\Shop\Admin\Export\Units;

use App\Shop\Admin\Categories\Category;
use App\Shop\Admin\Categories\Services\CategoryService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoriesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{    
    /**
     * Headings of columns 
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'Название категории',
            'slug категории',
            'Описание категории',
            'Статус',
            'Родитель',
            'Мета-заголовок',
            'Мета-описание',
            'Мета-ключи',
            'Категория в корзине'
        ];
    }
    
    /**
     * Columns on which a selection is made from the database
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'id', 
            'name', 
            'slug', 
            'description', 
            'is_active', 
            'category_id',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'deleted_at'
        ];
    }
    
    /**
     * Custom styles for excel files
     *
     * @param  Worksheet $sheet
     * 
     * @return void
     */
    public function styles(Worksheet $sheet)
    {
        $sheet
            ->getStyle('A1:J1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet
            ->getStyle('A1:J1')
            ->getFont()
            ->setBold(true);

        $sheet
            ->getStyle('A1:J1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFDCDCDC');
    }

    /**
     * Collection of categories
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        $categories = new CategoryService(new Category());
        $array = $categories->getAllRecords($this->columns());

        foreach($array as $category){
            if($category->description) {
                $category->description = htmlspecialchars_decode(strip_tags($category->description));
            }
        }

        return collect($array);
    }
}