<?php

namespace App\Http\Controllers;

use App\Entities\SpeedtestEntity;
use App\Http\Requests\CreateSpeedtestRequest;
use App\Http\Resources\SpeedtestResource;
use App\Services\Speedtest\SpeedtestService;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * @throws \Exception
     */
    public function create(
        CreateSpeedtestRequest $request,
        SpeedtestService $service
    ): JsonResponse
    {
        if ($request->has('file')) {
            $content = $request->file('file')->getContent();
        } else {
            $content = $request->input('data');
        }

        $entity = new SpeedtestEntity(json_decode($content));
        $model = $service->save($entity);

        return response()->json(
            SpeedtestResource::make($model)
        );
    }
}
