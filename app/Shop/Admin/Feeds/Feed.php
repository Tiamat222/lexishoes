<?php

namespace App\Shop\Admin\Feeds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    /**
     * morphTo
     *
     * @return MorphTo
     */
    public function feedable(): MorphTo
    {
        return $this->morphTo();
    }
}
