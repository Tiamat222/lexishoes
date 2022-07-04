<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Login\Requests\LoginRequest;
use App\Shop\Admin\Login\Services\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * LoginService instance
     *
     * @var LoginService
     */
    protected $loginService;

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
     * Show page with login form
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('admin-templates.login');
    }

    /**
     * Admin auth
     *
     * @param  Request $request
     * 
     * @return RedirectResponse
     */
    public function adminCheck(LoginRequest $request): RedirectResponse
    {
        if($this->loginService->userLoginAttempt(['login' => $request->login, 'password' => $request->password], 'admins')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    }

    /**
     * Admin logout
     *
     * @return RedirectResponse
     */
    public function adminLogout(): RedirectResponse
    {
        $this->loginService->logout('admins');
        return redirect()->route('admin.login');
    }
}
