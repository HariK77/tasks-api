<?php

namespace App\Http\Resources\Tasks;

use Illuminate\Http\Request;
use App\Http\Resources\Tasks\TaskResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => TaskResource::collection($this->collection),
        ];
    }
}
