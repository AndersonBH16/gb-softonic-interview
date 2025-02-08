<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class DetectDuplicatesURLsCommandTest  extends TestCase
{
    private $sourcePath;
    private $catalogPath;
    private $outputPath;

    public function setUp(): void
    {
        parent::setUp();

        $this->sourcePath = storage_path('input-files/source_publisher-url.csv');
        $this->catalogPath = storage_path('input-files/catalog_publisher-url.csv');
        $this->outputPath = storage_path('output-files/match_results.csv');

        if (!file_exists(dirname($this->sourcePath))) {
            mkdir(dirname($this->sourcePath), 0755, true);
        }
        if (!file_exists(dirname($this->outputPath))) {
            mkdir(dirname($this->outputPath), 0755, true);
        }

        file_put_contents($this->sourcePath,
            "1,https://example.com/app1\n" .
            "2,https://test.com/app2\n" .
            "3,https://similar-example.com/app3\n"
        );

        file_put_contents($this->catalogPath,
            "https://example.com/different\n" .
            "https://test.com/app2\n" .
            "https://another-example.com\n"
        );
    }

    public function tearDown(): void
    {
        if (file_exists($this->sourcePath)) {
            unlink($this->sourcePath);
        }
        if (file_exists($this->catalogPath)) {
            unlink($this->catalogPath);
        }
        if (file_exists($this->outputPath)) {
            unlink($this->outputPath);
        }

        @rmdir(dirname($this->sourcePath));
        @rmdir(dirname($this->outputPath));

        parent::tearDown();
    }

    public function test_command_detects_non_duplicates()
    {
        $this->artisan('app:detect-duplicates')
            ->assertSuccessful();

        $this->assertFileExists($this->outputPath);

        $output = file_get_contents($this->outputPath);

        $this->assertStringContainsString('1', $output);
        $this->assertStringContainsString('3', $output);
        $this->assertStringNotContainsString('2', $output);
    }

    public function test_command_handles_missing_files()
    {
        unlink($this->sourcePath);
        unlink($this->catalogPath);

        $this->artisan('app:detect-duplicates')
            ->assertFailed();
    }

    public function test_command_creates_output_directory()
    {
        if (file_exists(dirname($this->outputPath))) {
            rmdir(dirname($this->outputPath));
        }

        $this->artisan('app:detect-duplicates')
            ->assertSuccessful();

        $this->assertDirectoryExists(dirname($this->outputPath));
    }
}
