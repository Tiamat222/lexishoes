<?php

namespace App\Shop\Core\Traits;

use Illuminate\Foundation\Auth\ThrottlesLogins;

trait UserLoginTrait
{
    use ThrottlesLogins;

    /**
     * Max auth attempts
     *
     * @var int
     */
    protected $maxAttempts; 

    /**
     * Decay minutes
     *
     * @var int
     */
    protected $decayMinutes;

    /**
     * User login attempt
     *
     * @param  array $dataToLogin
     * 
     * @return bool
     */
    public function userLoginAttempt(array $dataToLogin, string $guard): bool
    {
        switch($guard) {
            case 'admins':
                $warningMessage = 'admin-login.admin-auth-warning';
                $errorMessage = 'admin-login.admin-login-exists';
                break;
            case 'customers':
                $warningMessage = 'front-login-customer.customer-login-warning';
                $errorMessage = 'front-login-customer.customer-login-warning';
                break;
        }

        if(method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts(request())) {
            $this->fireLockoutEvent(request());
            return $this->sendLockoutResponse(request());
        }
        if(auth()->guard($guard)->attempt($dataToLogin)) {
            if(get_auth_user($guard)->status == 0){
                $this->logout($guard);
                session()->flash('warning_message', __($warningMessage));
                return false;
            }
            $this->clearLoginAttempts(request());
            return true;
        } else {
            session()->flash('error_message', __($errorMessage));
            $this->incrementLoginAttempts(request());
            return false;
        }
    }

    /**
     * username
     *
     * @return string
     */
    public function username(): string
    {
        return 'email';
    }
    
    /**
     * User logout
     */
    public function logout(string $guard)
    {
        session()->flush();
        session()->regenerate();
        return auth()->guard($guard)->logout();
    }
}