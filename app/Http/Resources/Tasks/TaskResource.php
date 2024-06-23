<?php

namespace App\Http\Resources\Tasks;

use App\Http\Resources\Notes\NoteResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'description' => $this->description,
            'startDate' => $this->start_date->format('Y-m-d'),
            'dueDate' => $this->due_date->format('Y-m-d'),
            'priority' => $this->priority,
            'status' => $this->status,
            'notes' => NoteResource::collection($this->notes),
            'createdAt' => $this->created_at->diffForHumans(),
            'updatedAt' => $this->updated_at->diffForHumans(),
        ];
    }
}
