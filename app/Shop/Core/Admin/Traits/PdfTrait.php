<?php

namespace App\Shop\Core\Admin\Traits;

use Illuminate\Support\Facades\Storage;
use \Barryvdh\DomPDF\PDF as DomPdf;
use PDF;

trait PdfTrait
{
    /**
     * Store pdf on server
     *
     * @param  string $template
     * @param  mixed $data
     * 
     * @return DomPdf
     */
    private function createPdf(string $template, $data): DomPdf
    {
        return PDF::loadView($template, ['entity' => $data]);
    }

    /**
     * Store pdf on server
     *
     * @param  string $template
     * @param  mixed $data
     * 
     * @return void
     */
    public function storePdf(string $linkToTemplate, $dataToPdf)
    {
        $pdf = $this->createPdf($linkToTemplate, $dataToPdf);
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/files/pdf/document.pdf', $content);
        return storage_path('app/public/files/pdf/document.pdf');
    }
    
    /**
     * Delete pdf from server
     *
     * @param  string $fileLink
     * 
     * @return bool
     */
    public function destroyPdf(string $fileLink): bool
    {
        return delete_file($fileLink);
    }
}