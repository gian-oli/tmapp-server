<?php

namespace App\Services;

use App\Repositories\Contracts\ColumnContract;
use App\Repositories\Contracts\SwimlaneContract;
use App\Repositories\Contracts\TaskContract;

class TaskService
{
    protected $task_contract;
    protected $column_contract;
    protected $swimlane_contract;

    // Constructor injects the necessary repository contracts to manage tasks, columns, and swimlanes.
    public function __construct(
        TaskContract $task_contract,
        ColumnContract $column_contract,
        SwimlaneContract $swimlane_contract
    ) {
        $this->task_contract = $task_contract;
        $this->column_contract = $column_contract;
        $this->swimlane_contract = $swimlane_contract;
    }

    // Stores a new task using the TaskContract.
    public function store($data)
    {
        return $this->task_contract->store($data);
    }

    // Retrieves a task by its ID.
    public function show($id)
    {
        return $this->task_contract->show($id);
    }

    // Updates multiple tasks in a batch operation.
    public function batchUpdate($data)
    {
        // Updates each task individually; assumes the 'id' field is present in each task data.
        return collect($data)->map(function ($task) {
            return $this->task_contract->update($task['id'], $task);
        });
    }

    // Updates a single task by its ID.
    public function update($id, $data)
    {
        return $this->task_contract->update($id, $data);
    }

    // Stores multiple tasks in a batch operation.
    public function batchStore($data)
    {
        // Stores each task in the collection; assumes the input data is correctly formatted.
        return collect($data)->map(function ($task) {
            return $this->task_contract->store($task);
        });
    }

    // Moves a task to the next column in the swimlane, handling specific cases based on column position.
    public function nextColumn($swimlane_id, $id)
    {
        // Fetch swimlane details including its columns.
        $swimlane = $this->swimlane_contract->showSwimlane($swimlane_id);
        $columns = collect($swimlane->columns)->pluck('id'); // Extract column IDs.
        $task = $this->task_contract->show($id); // Fetch task details.

        // Determine the next column index based on the task's current column position.
        $next_column_index = $columns->search($task->column_id) + 1;

        // If there's a next column available, handle specific logic for column transitions.
        if (isset($columns[$next_column_index])) {
            // Specific handling when moving to the 3rd column (index 2).
            if ($next_column_index == 2) {
                // Prevent a user from having more than one task in the 3rd column.
                $user_id = $task->user_id; // Get task's associated user.
                $tasks_in_third_column_for_user = $this->task_contract->getTasksByColumnAndUser($columns[$next_column_index], $user_id);

                // If user already has a task in the 3rd column, throw an exception.
                if ($tasks_in_third_column_for_user->count() >= 1) {
                    throw new \Exception("The user already has a task in the 3rd column.");
                }

                // Preserve or set the start_date when transitioning to the 3rd column.
                $formatted_start_date = isset($task->start_date)
                    ? \Carbon\Carbon::parse($task->start_date)->format('Y-m-d H:i:s')
                    : \Carbon\Carbon::now()->format('Y-m-d H:i:s');

                // Update the task with the new column ID and start_date.
                $update_data = [
                    'column_id' => $columns[$next_column_index],
                    'start_date' => $formatted_start_date,
                ];
            } elseif ($next_column_index == 4) {
                // If moving to the 5th column, set the finished_at date to the current timestamp.
                $formatted_finished_date = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $update_data = [
                    'column_id' => $columns[$next_column_index],
                    'finished_at' => $formatted_finished_date,
                ];
            } else {
                // Default case: update only the column ID.
                $update_data = ['column_id' => $columns[$next_column_index]];
            }

            // Apply the updates to the task.
            return $this->task_contract->update($id, $update_data);
        } else {
            throw new \Exception("No next column available"); // No valid next column found.
        }
    }

    // Moves a task to the previous column in the swimlane, with validation for specific conditions.
    public function previousColumn($swimlane_id, $id)
    {
        // Fetch swimlane and its column details.
        $swimlane = $this->swimlane_contract->showSwimlane($swimlane_id);
        $columns = collect($swimlane->columns)->pluck('id'); // Extract column IDs.
        $task = $this->task_contract->show($id); // Fetch task details.

        // Determine the previous column index based on the current column position.
        $previous_column_index = $columns->search($task->column_id) - 1;

        // Check if the previous column index is valid and exists.
        if ($previous_column_index >= 0 && isset($columns[$previous_column_index])) {
            // If moving back to the 3rd column, ensure the user doesn't already have a task there.
            if ($previous_column_index == 2) {
                $user_id = $task->user_id;
                $tasks_in_third_column_for_user = $this->task_contract->getTasksByColumnAndUser($columns[$previous_column_index], $user_id);

                // Prevent a user from having multiple tasks in the 3rd column.
                if ($tasks_in_third_column_for_user->count() >= 1) {
                    throw new \Exception("The user already has a task in the 3rd column.");
                }
            }

            // Update the task to move it to the previous column.
            return $this->task_contract->update($id, ['column_id' => $columns[$previous_column_index]]);
        } else {
            throw new \Exception("No previous column available"); // No valid previous column found.
        }
    }
}
