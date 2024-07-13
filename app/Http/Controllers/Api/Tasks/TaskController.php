<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Services\Tasks\CreateTaskService;
use App\Services\Tasks\GetAllTaskService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\GetAllTaskRequest;
use App\Http\Resources\Tasks\TaskCollectionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetAllTaskRequest $request, GetAllTaskService $service): JsonResource
    {
        return new TaskCollectionResource($service->setAllTaskRequest($request)
            ->actOn());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request, CreateTaskService $service): JsonResponse
    {
        $result = $service->setCreateTaskRequest($request)->actOn();

        return $this->sendResponse($result['message'], $result['code']);
    }
}
