<?php
namespace App\Shop\Admin\AttributeValues;

use App\Shop\Admin\Attributes\Attribute;
use App\Shop\Admin\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Shop\Core\Admin\Traits\RecordFeed;

class AttributeValue extends Model
{
    use HasFactory, RecordFeed;
    
    /**
     * Db table
     *
     * @var string
     */
    protected $table = 'attributes_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'attribute_id'
    ];
        
    /**
     * Attribute value has attribute
     * 
     * @return BelongsTo
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
