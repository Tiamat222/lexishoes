<?php
namespace App\Shop\Admin\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Shop\Core\Admin\Traits\RecordFeed;

class Customer extends Model
{
    use HasFactory, SoftDeletes, RecordFeed;
    
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
        'adresscomment'
    ];
    
    public static function boot()
    {
        parent::boot();
    }
}
