<?php

namespace App\Services\Tasks;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Models\Note;
use App\Models\Task;

class CreateTaskService
{
    /**
     * @var CreateTaskRequest $request
     */
    protected CreateTaskRequest $request;

    /**
     * @param CreateTaskRequest $request
     * @return self
     */
    public function setCreateTaskRequest(CreateTaskRequest $request): self
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return CreateTaskRequest
     */
    public function getCreateTaskRequest(): CreateTaskRequest
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function process(): array
    {
        $result = [];
        try {
            $task = Task::create(
                $this->request->only([
                    'subject', 'description', 'start_date', 'due_date', 'status', 'priority'
                ])
            );

            foreach ($this->request->notes as $note) {
                Note::create(
                    [
                        'title' => $note['title'],
                        'task_id' => $task->id,
                        'attachments' => $this->handleAttachments($note['attachments']),
                        'note' => $note['note'],
                    ]
                );
            }
            $result['message'] = 'Task and related Notes are created successfully!';
            $result['code'] = Response::HTTP_CREATED;
        } catch (\Throwable $th) {
            $result['message'] = 'Task and related Notes are created successfully!';
            $result['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $result;
    }

    private function handleAttachments(array $attachments): string
    {
        $fileUrls = [];

        foreach ($attachments as $attachment) {

            $filenameWithExt = $attachment->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $fileName = $filename . '_' . time() . '.' . $attachment->getClientOriginalExtension();
            $attachment->move(public_path('attachments'), $fileName);
            $fileUrls[] = asset('attachments/' . $fileName);
        }

        return json_encode($fileUrls);
    }
}
