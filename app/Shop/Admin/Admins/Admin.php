<?php

namespace App\Shop\Admin\Admins;

use App\Shop\Admin\Feeds\Feed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Shop\Admin\Permissions\Permission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * Admin has permissions
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'admins_permissions')->orderBy('name');
    }
    
    /**
     * Admin has permission (by slug)
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
        return $this->hasMany(Feed::class);
    }
    
    /**
     * Latest feeds (last 3 days)
     *
     * @return HasMany
     */
    public function latestFeeds(): HasMany
    {
        return $this->hasMany(Feed::class)->where('created_at','>', Carbon::now()->addDays(-3));
    }
}
