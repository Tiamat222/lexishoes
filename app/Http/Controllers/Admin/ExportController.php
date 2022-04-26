<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Shop\Admin\Export\Services\ExportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\View\View;

class ExportController extends Controller 
{    
    /**
     * Show export page
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin-templates.settings.export');
    }
    
    /**
     * Export data to file
     *
     * @param  Request $request
     * @param  ExportService $exportService
     * 
     * @return BinaryFileResponse
     */
    public function unload(Request $request, ExportService $exportService): BinaryFileResponse
    {
        $unit = $exportService->getUnit($request['table']);
        return Excel::download(new $unit, $request['table'] . '.' . $request['extension']);
    }
}

