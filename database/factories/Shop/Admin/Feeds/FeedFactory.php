<?php
namespace Database\Factories\Shop\Admin\Feeds;

use App\Shop\Admin\Feeds\Feed;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FeedFactory extends Factory
{    
    /**
     * Model, associated with current factory
     *
     * @var Feed
     */
    protected $model = Feed::class;

    public function definition()
    {
        return [
            'admin_id' => 2,
            'admin_login' => 'Test admin',
            'type'=> 'create_admin',
            'feedable_id' => 1,
            'feedable_type' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
