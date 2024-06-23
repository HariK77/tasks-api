<?php

namespace App\Models;

use App\Enums\TaskStatus;
use App\Enums\TaskPriority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'description', 'start_date', 'due_date', 'status', 'priority'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
            'start_date' => 'datetime',
        ];
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function getAllTasks(
        ?string $status,
        ?string $due_date,
        ?string $priority,
        ?bool $note,
        ?string $orderByPriority,
        ?string $orderByFirst
    ): LengthAwarePaginator {

        $query = Task::query()->with('notes');

        $query->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        });

        $query->when($due_date, function ($query) use ($due_date) {
            $query->where('due_date', $due_date);
        });

        $query->when($priority, function ($query) use ($priority) {
            $query->where('priority', $priority);
        });

        $query->when($note, function ($query) {
            $query->whereHas('notes');
        });

        if ($orderByPriority) {
            $query->getOrderByPriority($orderByPriority);
        }

        if ($orderByFirst) {
            $query->withCount('notes')->orderBy('notes_count', $orderByFirst);
        }

        return $query->paginate(20);
    }

    public function scopeGetOrderByPriority(Builder $query, ?string $orderByPriority): void
    {
        $priorities = TaskStatus::all();
        sort($priorities);
        unset($priorities[array_search($orderByPriority, $priorities)]);
        array_unshift($priorities, $orderByPriority);

        $string = "case priority ";
        for ($i = 0; $i < count($priorities); $i++) {
            $string = $string . " when '$priorities[$i]' then " . $i + 1;
        }

        $string .= ' end';

        $query->orderByRaw($string);
    }
}
