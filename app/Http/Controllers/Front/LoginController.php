<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Shop\Front\Login\Requests\LoginRequest;
use App\Shop\Front\Login\Services\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * LoginService instance
     *
     * @var LoginService
     */
    private $loginService;

    /**
     * LoginController constructor
     *
     * @param  LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Show login/reg form
     *
     * @return View
     */
    public function showAuthForm(): View
    {
        return view('front-templates.login');
    }
    
    /**
     * Custumer login attempt
     *
     * @param  LoginRequest $request
     * 
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if($this->loginService->customerLoginAttempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('front.customer.profile');
        }
        return redirect()->route('front.login.show_form');
    }
    
    /**
     * Customer logout
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->loginService->logout();
        return redirect()
                ->route('front.login.show_form')
                ->with('success_message', __('front-login-customer.customer-logout'));
    }
}

