<?php

use App\Console\Commands\DetectedDuplicatesURLsCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:info {id}', function ($id) {
    $this->call('app:get-info', ['appId' => $id]);
})->describe('Get app information by ID');

Artisan::registerCommand(app(DetectedDuplicatesURLsCommand::class));

