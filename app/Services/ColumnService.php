<?php

namespace App\Services;
use App\Repositories\Contracts\ColumnContract;
use App\Repositories\Contracts\SwimlaneContract;
use App\Repositories\Contracts\TaskContract;

class ColumnService
{
    protected $column_contract;
    protected $swimlane_contract;
    protected $task_contract;

    public function __construct(
        ColumnContract $column_contract,
        SwimlaneContract $swimlane_contract,
        TaskContract $task_contract
    ) {
        $this->column_contract = $column_contract;
        $this->swimlane_contract = $swimlane_contract;
        $this->task_contract = $task_contract;
    }
    public function store($data)
    {
        return $this->column_contract->store($data);
    }
    public function backlogColumn($id)
    {
        return $this->column_contract->backlogColumn($id);
    }
    public function columnTasks($id)
    {
        return $this->column_contract->columnTasks($id);
    }
    public function backlogToReady($swimlane_id, $column_id)
    {
        $backlog_tasks_ids = collect($this->column_contract->columnTasks($column_id)->tasks)->map(function ($task) {
            return $task->id;
        });
        
        $swimlane = $this->swimlane_contract->showSwimlane($swimlane_id);
        $column_ready = collect($swimlane->columns)->map(function($column) {
            return $column->id;
        })[1];

        return collect($backlog_tasks_ids)->map(function($id) use ($column_ready) {
            return $this->task_contract->update($id, ['column_id' => $column_ready]);
        });
    }
}