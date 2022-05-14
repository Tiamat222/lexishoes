<?php

namespace App\Shop\Front\Register;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;
    
    /**
     * Associated table
     *
     * @var string
     */
    protected $table = 'customers';
    
    /**
     * Timestamps ON
     *
     * @var bool
     */
    public $timestamps = true;
     
    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'dop_phone',
        'address',
        'status',
        'password',
        'comment',
        'token',
    ];
}
