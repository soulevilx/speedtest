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
    public function create(CreateSpeedtestRequest $request): JsonResponse
    {
        $service = app(SpeedtestService::class);

        if ($request->has('file')) {
            $entity = new SpeedtestEntity(
                json_decode($request->file('file')->getContent())
            );
        } else {
            $entity = new SpeedtestEntity(
                json_decode($request->input('data'))
            );
        }

        $model = $service->save($entity);

        return response()->json(
            SpeedtestResource::make($model)
        );
    }
}
