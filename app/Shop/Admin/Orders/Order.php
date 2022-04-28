<?php

namespace App\Shop\Admin\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Shop\Core\Admin\Traits\RecordFeed;

class Order extends Model
{
    use HasFactory, RecordFeed;

    /**
     * Associated table
     *
     * @var string
     */
    protected $table = 'orders';

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
        'order_id',
        'total_price',
        'status',
    ];
    
    public static function boot()
    {
        parent::boot();
    }
}