<?php

namespace App\Shop\Admin\Customers\Email;

use App\Shop\Admin\Customers\Exceptions\SendEmailErrorException;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Swift_TransportException;

class CustomerEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The instance.
     */
    public $instance;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($instance)
    {
        $this->instance = $instance;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            return $this->from(env('MAIL_USERNAME'))
                        ->subject(__('admin-customers.customer-report') . $this->instance->first_name . ' ' . $this->instance->last_name)
                        ->view('admin-templates.customers.email')
                        ->attach(storage_path('app/public/files/pdf/document.pdf'));
        } catch(Swift_TransportException $e) {
            throw new SendEmailErrorException($e->getMessage());
        }
    }
}
