<?php

namespace App\Shop\Front\Register\Email;

use App\Shop\Admin\Customers\Exceptions\SendEmailErrorException;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Swift_TransportException;

class CustomerRegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Customer data to send.
     */
    public $customerData;

    /**
     * Create a new message instance.
     */
    public function __construct(array $customerData)
    {
        $this->customerData = $customerData;
    }

    /**
     * Build the message.
     *
     * @throws SendEmailErrorException
     * @return $this
     */
    public function build()
    {
        try {
            return $this->from(env('MAIL_USERNAME'))
                        ->subject(__('front-reg-customer.customer-reg-subject'))
                        ->view('front-templates.registration.mail', [
                            'token' => $this->customerData['customer_token'],
                            'id' => $this->customerData['customer_id']
                        ]);
        } catch(Swift_TransportException $e) {
            throw new SendEmailErrorException($e->getMessage());
        }
    }
}
