<?php

namespace App\Http\Controllers;

use App\Application\Services\AppService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppController extends Controller
{
    private AppService $appService;

    public function __construct(AppService $appService)
    {
        $this->appService = $appService;
    }

    public function getDataById(string $appId): JsonResponse
    {
        try {
            $appInfo = $this->appService->getAppInfo($appId);
            return response()->json($appInfo, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404, [], JSON_PRETTY_PRINT);
        }
    }
}
