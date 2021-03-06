<?php

namespace App\Shop\Admin\Suppliers;

use App\Shop\Admin\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Shop\Core\Admin\Traits\RecordFeed;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    use HasFactory, SoftDeletes, RecordFeed;
    
    /**
     * Table associated with the model
     *
     * @var string
     */
    protected $table = 'suppliers';
    
    /**
     * Timestamps true
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
        'name', 
        'description',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();
    }
    
    /**
     * Supplier has products
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
