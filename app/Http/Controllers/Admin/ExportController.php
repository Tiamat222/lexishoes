<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Export\Services\ExportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller 
{    
    /**
     * Show export page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin-templates.settings.export');
    }
    
    /**
     * Export data to file
     *
     * @param  Request $request
     * @param  ExportService $exportService
     * 
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function unload(Request $request, ExportService $exportService)
    {
        $unit = $exportService->getUnit($request['table']);
        return Excel::download(new $unit, $request['table'] . '.' . $request['extension']);
    }
}

