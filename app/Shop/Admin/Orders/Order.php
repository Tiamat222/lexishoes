<?php

namespace App\Shop\Admin\Orders;

use App\Shop\Admin\Customers\Customer;
use App\Shop\Admin\OrderComments\OrderComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Shop\Core\Admin\Traits\RecordFeed;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Order has customers
     *
     * @return BelongsToMany
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }

    /**
     * Order has comments
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(OrderComment::class);
    }
}