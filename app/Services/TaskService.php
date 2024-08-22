<?php

namespace App\Services;
use App\Repositories\Contracts\TaskContract;

class TaskService {
    protected $task_contract;

    public function __construct(TaskContract $task_contract){
        $this->task_contract = $task_contract;
    }

    public function store($data){
        return $this->task_contract->store($data);
    }

    public function show($id)
    {
        $tasks = $this->task_contract->showTasksWithRelation($id);
        return $tasks->map(function($task){
            return [
                'id' => $task->id,
                'user_id' => $task->user_id,
                'priority_id' => $task->priority_id,
                'project_id' => $task->project_id,
                'description' => $task->description,
                'due_date' => $task->due_date,
                'assigned_by' => $task->assigned_by,
                'priority_level' => $task->priorities->priority_name,
                'project_name' => $task->project->project_name,
                'assigned_to' => $task->user->username,
                'comments' => $task->comments ?? [],
            ];
        });
    }
}