<?php

namespace App\Shop\Admin\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * Db table
     *
     * @var string
     */
    protected $table = 'general_settings';

    /**
     * Timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'setting', 
        'value',
    ];

}
