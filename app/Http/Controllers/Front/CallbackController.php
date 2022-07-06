<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Shop\Front\Callback\Requests\CreateCallbackRequest;
use App\Shop\Front\Callback\Services\CallbackService;
use Illuminate\Http\RedirectResponse;

class CallbackController extends Controller
{
    /**
     * Store new callback request
     *
     * @param  Request $request
     * 
     * @return RedirectResponse
     */
    public function store(CreateCallbackRequest $request, CallbackService $callbackService)
    {
        $callbackService->store($request->only(['name', 'phone']));
        return redirect()
                ->back()
                ->with('success_message', __('front-callback.callback-send-success'));
    }
}