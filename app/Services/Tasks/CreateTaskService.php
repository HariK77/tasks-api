<?php

namespace App\Services\Tasks;

use App\Helpers\UploadHelper;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Tasks\CreateTaskRequest;
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

            $task->notes()->createMany(
                $this->formattedNotesData(
                    $this->request->validated('notes')
                )
            );

            $result['message'] = 'Task and related Notes are created successfully!';
            $result['code'] = Response::HTTP_CREATED;
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $result;
    }

    protected function formattedNotesData(array $notes): array
    {
        $formatted = [];
        foreach ($notes as $note) {
            $formatted[] = [
                'subject' => $note['subject'],
                'note' => $note['note'],
                'attachments' => json_encode(
                    UploadHelper::multipleFileUpload('attachments', $note['attachments'])
                ),
            ];
        }

        return $formatted;
    }
}
