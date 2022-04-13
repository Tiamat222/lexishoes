<?php

namespace App\Shop\Admin\Admins;

use App\Shop\Admin\Feeds\Feed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Shop\Admin\Permissions\Permission;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    
    /**
     * Db table
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 
        'email', 
        'password', 
        'telephone',
        'avatar',
        'status',
        'admin_id',
    ];
        
    /**
     * Admin have permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'admins_permissions');
    }
    
    /**
     * Admin has permission
     *
     * @param  string $permission
     * 
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    /**
     * Admin has feeds
     *
     * @return HasMany
     */
    public function feeds(): HasMany
    {
        return $this->hasMany(Feed::class)->where('created_at','>', \Carbon\Carbon::now()->addDays(-100));
    }
    
    /**
     * Latest feeds
     *
     * @return HasMany
     */
    public function latestFeeds(): HasMany
    {
        return $this->hasMany(Feed::class)->where('created_at','>', \Carbon\Carbon::now()->addDays(-2));
    }
}
