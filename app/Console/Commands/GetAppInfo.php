<?php

namespace App\Console\Commands;

use App\Services\AppInfoService;
use Illuminate\Console\Command;

class GetAppInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:info {appId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get app information by id';
    protected $appInfoService;

    public function __construct(AppInfoService $appInfoService)
    {
        parent::__construct();
        $this->appInfoService = $appInfoService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $appId = $this->argument('appId');
        $appInfo = $this->appInfoService->getAppInfoById($appId);

        if (empty($appInfo)) {
            $this->error('App not found!');
            return;
        }

        $this->info(json_encode($appInfo, JSON_PRETTY_PRINT));
    }
}
