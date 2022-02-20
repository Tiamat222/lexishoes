<?php
namespace App\Shop\Admin\Attributes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Shop\Admin\AttributeValues\AttributeValue;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Shop\Core\Admin\Traits\RecordFeed;

class Attribute extends Model
{
    use HasFactory, RecordFeed;
    
    /**
     * Db table
     *
     * @var string
     */
    protected $table = 'attributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
            
    /**
     * Attribute has values
     *
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }
}
