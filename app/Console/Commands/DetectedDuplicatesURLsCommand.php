<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class DetectedDuplicatesURLsCommand extends Command
{
    protected $signature = 'app:detect-duplicates';
    protected $description = 'Detect duplicates URL from csv files';

    private $sourceFile;
    private $catalogFile;
    private $outputFile;

    public function __construct()
    {
        parent::__construct();
        $this->sourceFile = storage_path('input-files/source_publisher-url.csv');
        $this->catalogFile = storage_path('input-files/catalog_publisher-url.csv');
        $this->outputFile = storage_path('output-files/match_results.csv');
    }

    public function handle()
    {
        $this->ensureDirectoriesExist();

        if (!file_exists($this->sourceFile) || !file_exists($this->catalogFile)) {
            $this->error('Missing input files.');
            return Command::FAILURE;
        }

        $scriptPath = base_path('scripts/match_urls.sh');
        if (!file_exists($scriptPath)) {
            $this->error('Script not found: ' . $scriptPath);
            return Command::FAILURE;
        }

        $process = Process::fromShellCommandline("bash $scriptPath {$this->sourceFile} {$this->catalogFile} {$this->outputFile} 0.85");

        $process->setTimeout(0); // No timeout
        $process->setIdleTimeout(null);

        $this->info('Starting duplicate detection...');

        try {
            $process->mustRun(function ($type, $buffer) {
                $type === Process::ERR ? $this->error($buffer) : $this->info($buffer);
            });

            $this->info('Duplicate detection completed successfully!');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function ensureDirectoriesExist()
    {
        foreach ([dirname($this->outputFile)] as $directory) {
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
        }
    }
}
