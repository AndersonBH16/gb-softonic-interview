<?php

namespace App\Application\Services;

use App\Domain\Models\App;
use App\Domain\Models\Developer;
use App\Infrastructure\Services\AppDataService;

class AppService
{
    private AppDataService $appDataService;

    public function __construct(AppDataService $appDataService)
    {
        $this->appDataService = $appDataService;
    }

    public function getAppInfo(string $appId): array
    {
        $appData = $this->appDataService->getAppData($appId);
        if (!$appData) {
            throw new \Exception("App with ID {$appId} not found");
        }

        $developerData = $this->appDataService->getDeveloperData($appData['developer_id']);
        if (!$developerData) {
            throw new \Exception("Developer with ID {$appData['developer_id']} not found");
        }

        $app = new App(
            (string) $appData['id'],
            $appData['title'],
            $appData['version'],
            $appData['url'],
            $appData['short_description'],
            $appData['license'],
            $appData['thumbnail'],
            $appData['rating'],
            (string) $appData['total_downloads'],
            $appData['compatible']
        );

        $developer = new Developer(
            $developerData['name'],
            $developerData['url']
        );

        return [
            'id' => $app->id,
            'author_info' => [
                'name' => $developer->name,
                'url' => $developer->url,
            ],
            'title' => $app->title,
            'version' => $app->version,
            'url' => $app->url,
            'short_description' => $app->shortDescription,
            'license' => $app->license,
            'thumbnail' => $app->thumbnail,
            'rating' => $app->rating,
            'total_downloads' => $app->totalDownloads,
            'compatible' => implode('|', $app->compatible),
        ];
    }
}
