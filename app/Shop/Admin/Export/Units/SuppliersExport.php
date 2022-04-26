<?php
namespace App\Shop\Admin\Export\Units;

use App\Shop\Admin\Suppliers\Services\SupplierService;
use App\Shop\Admin\Suppliers\Supplier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuppliersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
            'Имя поставщика', 
            'Комментарий', 
            'Дата создания',
            'Был удален (мягкое удаление)'
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
            'description', 
            'created_at',
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
            ->getStyle('A1:E1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet
            ->getStyle('A1:E1')
            ->getFont()
            ->setBold(true);

        $sheet
            ->getStyle('A1:E1')
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
        $suppliers = new SupplierService(new Supplier());
        $array = $suppliers->getAllRecords($this->columns());

        foreach($array as $supplier){
            if($supplier->description) {
                $supplier->description = htmlspecialchars_decode(strip_tags($supplier->description));
            }
        }
        
        return collect($array);
    }
}