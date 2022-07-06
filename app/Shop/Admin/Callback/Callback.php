<?php

namespace App\Shop\Admin\Callback;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    use HasFactory;
    
    /**
     * Associated table
     *
     * @var string
     */
    protected $table = 'callbacks';
    
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
        'name',
        'phone',
        'comment',
        'status',
    ];
}
