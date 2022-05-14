<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Shop\Front\Register\Requests\CreateCustomerRequest;
use App\Shop\Front\Register\Requests\CustomerEmailRequest;
use App\Shop\Front\Register\Services\RegisterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * RegisterService instance
     *
     * @var RegisterService
     */
    private $registerService;
    
    /**
     * RegisterController constructor
     *
     * @param  RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }
    
    /**
     * Register new customer
     *
     * @param  CreateCustomerRequest $request
     * 
     * @return RedirectResponse
     */
    public function registerNewCustomer(CreateCustomerRequest $request): RedirectResponse
    {
        $this->registerService->store($request->data());
        return redirect()
                ->route('front.register.confirm_customer')
                ->with('token', make_token());
    }
    
    /**
     * Confirm message for new customer
     *
     * @return View
     */
    public function confirmCustomer(): View
    {
        if(session()->has('token')) {
            return view('front-templates.registration.confirm');
        }
        abort(404);
    }
    
    /**
     * Confirm customer token
     *
     * @param  string $token
     * @param  int $id
     * 
     * @return void
     */
    public function confirmToken(string $token, int $id)
    {
        if($this->registerService->checkToken($token, $id)) {
            return redirect()
                    ->route('front.login.show_form')
                    ->with('success_message', __('front-reg-customer.customer-reg-success'));
        }
        return redirect()
                ->route('front.register.expired_token')
                ->with('token', make_token());
    }
    
    /**
     * Show message if token was expired
     *
     * @return void
     */
    public function expiredToken()
    {
        if(session()->has('token')) {
            return view('front-templates.registration.expired-token');
        }
        abort(404);
    }
    
    /**
     * Resending email with registration token
     *
     * @param  CustomerEmailRequest $request
     * 
     * @return void
     */
    public function resending(CustomerEmailRequest $request)
    {
        $this->registerService->resendEmail($request->email);
        return redirect()
                ->route('front.register.confirm_customer')
                ->with('token', make_token());
    }
}

