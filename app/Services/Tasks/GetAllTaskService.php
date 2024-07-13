<?php

namespace App\Services\Tasks;

use App\Http\Requests\Tasks\GetAllTaskRequest;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class GetAllTaskService
{
    public function __construct(
        private Task $task
    ) {
    }
    /**
     * @var GetAllTaskRequest $request
     */
    protected GetAllTaskRequest $request;

    /**
     * @param GetAllTaskRequest $request
     * @return self
     */
    public function setAllTaskRequest(GetAllTaskRequest $request): self
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return GetAllTaskRequest
     */
    public function getAllTaskRequest(): GetAllTaskRequest
    {
        return $this->request;
    }

    public function actOn(): LengthAwarePaginator
    {
        $notes = $this->request->filter['notes'] ?? null;
        return $this->task->getAllTasks(
            $this->request->filter['status'] ?? null,
            $this->request->filter['due_date'] ?? null,
            $this->request->filter['priority'] ?? null,
            $notes == 'true' ? true : false,
            $this->request->order['priority'] ?? null,
            $this->request->order['first'] ?? null,
        );
    }
}
