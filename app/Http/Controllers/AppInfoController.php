<?php

namespace App\Http\Controllers;

use App\Services\AppInfoService;
use Illuminate\Http\JsonResponse;

class AppInfoController extends Controller
{
    protected $appInfoService;

    public function __construct(AppInfoService $appInfoService)
    {
        $this->appInfoService = $appInfoService;
    }

    public function getIdInfoApp(string $appId): JsonResponse
    {
        $appInfo = $this->appInfoService->getAppInfoById($appId);

        if (empty($appInfo)) {
            return response()->json(['error' => 'App not found'], 404);
        }

        return response()->json($appInfo);
    }
}
