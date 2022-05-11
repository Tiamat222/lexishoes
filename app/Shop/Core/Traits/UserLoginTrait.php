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
    public function customerLoginAttempt(array $dataToLogin): bool
    {
        if(method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts(request())) {
            $this->fireLockoutEvent(request());
            return $this->sendLockoutResponse(request());
        }
        if(auth()->guard('customers')->attempt($dataToLogin)) {
            if(get_auth_user('customers')->status !== 1){
                if(get_current_route() == 'front.login.check') {
                    session()->flash('warning_message', __('front-login-customer.customer-login-warning'));
                }
                return false;
            }
            $this->clearLoginAttempts(request());
            return true;
        } else {
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
    public function logout()
    {
        session()->flush();
        session()->regenerate();
        return auth()->guard('customers')->logout();
    }
}