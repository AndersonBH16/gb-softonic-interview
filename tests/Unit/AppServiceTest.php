<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Application\Services\AppService;
use App\Infrastructure\Services\AppDataService;

class AppServiceTest extends TestCase
{
    public function testGetAppInfoReturnsExpectedFormat()
    {
        $stub = $this->createStub(AppDataService::class);

        $stub->method('getAppData')
            ->willReturn([
                'id' => '21824',
                'developer_id' => '23',
                'title' => 'Ares',
                'version' => '2.4.0',
                'url' => 'http://ares.en.softonic.com',
                'short_description' => 'Fast and unlimited P2P file sharing',
                'license' => 'Free (GPL)',
                'thumbnail' => 'https://screenshots.en.sftcdn.net/en/scrn/21000/21824/ares-14-100x100.png',
                'rating' => 8,
                'total_downloads' => '4741260',
                'compatible' => [
                    "Windows 2000",
                    "Windows XP",
                    "Windows Vista",
                    "Windows 7",
                    "Windows 8"
                ],
            ]);

        $stub->method('getDeveloperData')
            ->willReturn([
                'id' => '23',
                'name' => 'AresGalaxy',
                'url' => 'https://aresgalaxy.io/'
            ]);

        $appService = new AppService($stub);

        $result = $appService->getAppInfo('21824');

        $expected = [
            'id' => '21824',
            'author_info' => [
                'name' => 'AresGalaxy',
                'url' => 'https://aresgalaxy.io/',
            ],
            'title' => 'Ares',
            'version' => '2.4.0',
            'url' => 'http://ares.en.softonic.com',
            'short_description' => 'Fast and unlimited P2P file sharing',
            'license' => 'Free (GPL)',
            'thumbnail' => 'https://screenshots.en.sftcdn.net/en/scrn/21000/21824/ares-14-100x100.png',
            'rating' => 8,
            'total_downloads' => '4741260',
            'compatible' => 'Windows 2000|Windows XP|Windows Vista|Windows 7|Windows 8',
        ];

        $this->assertEquals($expected, $result);
    }
}
