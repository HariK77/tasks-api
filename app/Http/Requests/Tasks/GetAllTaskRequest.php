<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetAllTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filter.status' => ['sometimes', Rule::in(TaskStatus::all())],
            'filter.priority' => ['sometimes', Rule::in(TaskPriority::all())],
            'filter.due_date' => ['sometimes', 'date_format:Y-m-d'],
            'filter.notes' => ['sometimes', 'required'],
            'order.priority' => ['sometimes', Rule::in(TaskPriority::all())],
            'order.first' => ['sometimes', 'in:asc,desc'],
        ];
    }
}
