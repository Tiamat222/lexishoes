<?php

namespace App\Shop\Admin\Pages;

use Illuminate\Database\Eloquent\Model;
use App\Shop\Core\Admin\Traits\RecordFeed;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, RecordFeed;

    /**
     * Associated table
     *
     * @var string
     */
    protected $table = 'pages';

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
        'title',
        'text',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public static function boot()
    {
        parent::boot();
    }
}