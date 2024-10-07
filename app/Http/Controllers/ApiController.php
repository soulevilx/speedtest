<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpeedtestRequest;
use App\Http\Resources\SpeedtestResource;
use App\Models\Speedtest;
use App\Services\Speedtest\Entities\SpeedtestEntity;
use App\Services\Speedtest\SpeedtestService;

class ApiController extends Controller
{
    public function create(CreateSpeedtestRequest $request)
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

        $model = $service->save(
            $request->input('hostname'),
            $request->input('ip'),
            $entity
        );

        return response()->json(
            SpeedtestResource::make($model)
        );
    }
}
