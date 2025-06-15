<?php

namespace App\Services;

use App\Entities\SpeedtestEntity;
use App\Http\Requests\CreateSpeedtestRequest;
use App\Http\Resources\SpeedtestResource;
use App\Services\Speedtest\SpeedtestService;
use Exception;
use Illuminate\Http\JsonResponse;

readonly class SpeedTestApiService
{
    public function __construct(private SpeedtestService $service)
    {
    }

    /**
     * @throws Exception
     */
    public function save(CreateSpeedtestRequest $request): JsonResponse
    {
        if ($request->has('file')) {
            $entity = new SpeedtestEntity(
                json_decode($request->file('file')->getContent())
            );
        } else {
            $entity = new SpeedtestEntity($request->toArray());
        }

        $model = $this->service->save($entity);

        return response()->json(
            SpeedtestResource::make($model)
        );
    }
}
