<?php

namespace App\Shop\Admin\OrderComments;

use App\Shop\Admin\Customers\Customer;
use App\Shop\Admin\Orders\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Shop\Core\Admin\Traits\RecordFeed;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderComment extends Model
{
    use HasFactory, RecordFeed;

    /**
     * Associated table
     *
     * @var string
     */
    protected $table = 'order_comments';

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
        'admin_login',
        'comment',
    ];

    public static function boot()
    {
        parent::boot();
    }

    /**
     * Comment has order
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}