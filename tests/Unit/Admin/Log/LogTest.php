<?php

namespace Tests\Unit\Admin\Log;

use App\Shop\Admin\Log\Services\LogService;
use App\Shop\Core\Admin\Base\Exceptions\FileNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * LogService instance
     *
     * @var LogService
     */
    private $logService;
    
    /**
     * FilesystemAdapter instance
     *
     * @var FilesystemAdapter
     */
    private $disk;
    
    /**
     * Path to log files
     *
     * @var string
     */
    private $pathToLogFiles;

    public function setUp(): void
    {
        parent::setUp();

        $this->logService = new LogService();
        $this->disk = Storage::fake('logs');
        $this->disk->put('testFile.log', '[2021-11-28 17:04:29] local.ALERT:');
        $this->pathToLogFiles = $this->disk->getDriver()->getAdapter()->getPathPrefix();
    }

    /** @test */
    public function the_content_of_the_log_file_can_be_retrieved()
    {
        $getContent = $this->logService->getLogfilesContent($this->pathToLogFiles);
        $this->assertIsArray($getContent);
        $this->assertCount(1, $getContent);
        $this->assertArrayHasKey('testFile.log', $getContent);
        $this->assertEquals('[2021-11-28 17:04:29] local.ALERT:', $getContent['testFile.log']);
    }

    /** @test */
    public function log_file_can_be_cleared()
    {
        $clearFile = $this->logService->clearLogFile($this->pathToLogFiles . 'testFile.log');
        $this->assertTrue($clearFile);
        $this->assertEquals('', file_get_contents($this->pathToLogFiles . 'testFile.log'));
    }

    /** @test */
    public function throw_exception_if_path_to_log_files_wrong()
    {
        $this->expectException(FileNotFoundException::class);
        $this->logService->getLogfilesContent($this->pathToLogFiles . '/wrong-part');
    }

    /** @test */
    public function throw_an_exception_if_no_log_file_was_found_during_cleaning()
    {
        $this->expectException(FileNotFoundException::class);
        $this->logService->clearLogFile($this->pathToLogFiles . 'testFileWrong.log');
    }
}
