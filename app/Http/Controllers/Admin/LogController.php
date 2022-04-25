<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Log\Services\LogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
     * @return View
     */
    public function index(): View
    {
        return view('admin-templates.settings.log', [
            'logs' => $this->logService->getLogfilesContent($this->pathToLogFiles)
        ]);
    }
    
    /**
     * Clear log files
     *
     * @return RedirectResponse
     */
    public function clearLogFile(string $param): RedirectResponse
    {
        $this->logService->clearLogFile($this->pathToLogFiles . '/' . $param);
        return redirect()
            ->route('admin.settings.log.index')
            ->with('success_message', $param . ' ' . __('admin-log.log-success'));
    }
}
