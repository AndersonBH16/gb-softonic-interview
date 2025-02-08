<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class AppInfoService
{
    public function getAppInfoById(string $appId): array
    {
        $apps = json_decode(File::get(storage_path('app/app.json')), true);
        $developers = json_decode(File::get(storage_path('app/developer.json')), true);

        $appInfo = collect($apps)->firstWhere('id', $appId);

        if (!$appInfo) {
            return [];
        }

        $developerInfo = collect($developers)->firstWhere('id', $appInfo['developer_id']);

        return [
            'id' => $appInfo['id'],
            'author_info' => [
                'name' => $developerInfo['name'],
                'url' => $developerInfo['url'],
            ],
            'title' => $appInfo['title'],
            'version' => $appInfo['version'],
            'url' => $appInfo['url'],
            'short_description' => $appInfo['short_description'],
            'license' => $appInfo['license'],
            'thumbnail' => $appInfo['thumbnail'],
            'rating' => $appInfo['rating'],
            'total_downloads' => $appInfo['total_downloads'],
            'compatible' => implode('|', $appInfo['compatible']),
        ];
    }
}
