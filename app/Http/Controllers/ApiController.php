<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpeedtestRequest;
use App\Services\SpeedTestApiService;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * @throws Exception
     */
    public function create(CreateSpeedtestRequest $request): JsonResponse
    {
        return app(SpeedTestApiService::class)->save($request);
    }
}
