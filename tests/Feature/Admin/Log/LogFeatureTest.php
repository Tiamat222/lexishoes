<?php

namespace Tests\Feature\Admin\Log;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase; 
    
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        file_put_contents(storage_path('logs/testFile.log'), 'Test message');
    }

    /** @test **/
    public function settings_log_page_can_be_shown()
    {
        $this
            ->get(route('admin.settings.log.index'))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertSee('Test message');

        unlink(storage_path('logs/testFile.log'));
    }

    /** @test **/
    public function log_file_can_be_cleared()
    {
        $this
            ->get(route('admin.settings.log.clear', 'testFile.log'))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.log.index'));

        unlink(storage_path('logs/testFile.log'));
    }
}
