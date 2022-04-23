<?php
namespace App\Shop\Core\Admin\Traits;

use App\Shop\Admin\Feeds\Feed;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait RecordFeed
{    
    /**
     * Boot records activity
     *
     * @return void
     */
    public static function booted(): void
    {
        foreach (static::getModelEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordFeed($event);
            });
        }

        static::deleted(function ($model) {
            $model->feeds()->delete();
            $model->recordFeed('force_deleted');
        });
    }
    
    /**
     * Get model events
     *
     * @return array
     */
    protected static function getModelEvents(): array
    {
        return [
            'created',
            'updated',
        ];
    }
    
    /**
     * Record feed in db
     *
     * @param  string $event
     * @return void
     */
    private function recordFeed(string $event): void
    {
        $admin = auth()->guard('admins')->user();
        $this->feeds()->create([
            'admin_id' => $admin->id,
            'admin_login' => $admin->login,
            'type' => $event . '_' . strtolower(class_basename($this))
        ]);
    }
    
    /**
     * Feeds 
     *
     * @return MorphMany
     */
    private function feeds(): MorphMany
    {
        return $this->morphMany(Feed::class, 'feedable');
    }
}