<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Log\Services\LogService;

class LogController extends Controller
{    
    /**
     * LogService instance
     * 
     * @var LogService
     */
    private $logService;
    
    /**
     * Path to log files
     *
     * @var string
     */
    private $pathToLogFiles;
    
    /**
     * LogController constructor
     * 
     * @param  LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
        $this->pathToLogFiles = storage_path('logs');
    }
    
    /**
     * Show log files content
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $logs = $this->logService->getLogfilesContent($this->pathToLogFiles);
        return view('admin-templates.settings.log', compact('logs'));
    }
    
    /**
     * Clear log files
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearLogFile($param)
    {
        if($this->logService->clearLogFile($this->pathToLogFiles . '/' . $param)) {
            return redirect()->route('admin.settings.log.index')->with('success_message', $param . ' ' . __('admin-log.success'));
        }
    }
}
