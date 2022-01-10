<?php

namespace App\Shop\Admin\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'general_settings';

    public $timestamps = false;

    protected $fillable = [
        'setting', 
        'value',
    ];

}
