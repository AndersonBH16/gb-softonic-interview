<?php

namespace App\Console\Commands;

use App\Application\Services\AppService;
use Illuminate\Console\Command;

class GetAppInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-info {appId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get app information by id';

    private AppService $appService;

    public function __construct(AppService $appService)
    {
        parent::__construct();
        $this->appService = $appService;
    }

    public function handle(): void
    {
        $appId = $this->argument('appId');

        try {
            $appInfo = $this->appService->getAppInfo($appId);
            $this->info(json_encode($appInfo, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
