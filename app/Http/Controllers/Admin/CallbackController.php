<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Callback\Services\CallbackService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CallbackController extends Controller
{    
    /**
     * CallbackService instance
     *
     * @var CallbackService
     */
    private $callbackService;
    
    /**
     * CallbackController constructor
     *
     * @param  CallbackService $callbackService
     */
    public function __construct(CallbackService $callbackService)
    {
        $this->callbackService = $callbackService;
    }

    /**
     * Display a listing of the callbacks.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin-templates.callbacks.list', [
            'callbacks' => $this->callbackService->getAllRecordsPaginate(get_setting('items_per_page'))
        ]);
    }

    /**
     * Show the form for editing the callback
     *
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin-templates.callbacks.edit', [
            'callback' => $this->callbackService->getRecordById($id)
        ]);
    }

    /**
     * Update callback
     *
     * @param  Request $request
     * 
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $this->callbackService->update($request->only(['id', 'status', 'comment']));
        return redirect()
                ->back()
                ->with('success_message', __('admin-callbacks.callback-update'));
    }

    /**
     * Callback force delete
     *
     * @param  int $id
     * 
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->callbackService->destroyRecord($id);
        return redirect()
                ->route('admin.callbacks.index')
                ->with('success_message', __('admin-callbacks.callback-force-delete'));
    }
}

