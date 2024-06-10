<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpeedtestRequest;
use App\Http\Resources\SpeedtestResource;
use App\Services\SpeedtestService;

class ApiController extends Controller
{

    public function create(CreateSpeedtestRequest $request)
    {
        if ($request->has('file')) {
            $file = $request->file('file');
            $model = app(SpeedtestService::class)
                ->save($file->getContent());
        } else {
            $model = app(SpeedtestService::class)
                ->save($request->input('data'));
        }

        return response()->json(
            SpeedtestResource::make($model)
        );
    }
}
