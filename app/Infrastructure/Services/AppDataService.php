<?php

namespace App\Infrastructure\Services;

use Illuminate\Support\Facades\File;

class AppDataService
{
    public function getAppData(string $appId): ?array
    {
        $apps = json_decode(File::get(storage_path('external-files/app.json')), true);
        return collect($apps)->firstWhere('id', $appId);
    }

    public function getDeveloperData(string $developerId): ?array
    {
        $developers = json_decode(File::get(storage_path('external-files/developer.json')), true);
        return collect($developers)->firstWhere('id', $developerId);
    }
}
