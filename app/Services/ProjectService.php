<?php

namespace App\Services;
use App\Repositories\Contracts\ProjectContract;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    protected $project_contract;

    public function __construct(ProjectContract $project_contract)
    {
        $this->project_contract = $project_contract;
    }

    public function store($data)
    {
        return $this->project_contract->store($data);
    }

    public function load()
    {
        return $this->project_contract->load();
    }

    public function loadProjectWithRelations()
    {
        // Load projects with their related data
        $projects = $this->project_contract->loadProjectWithRelations();

        // If no projects are found or the result is null, return an empty array
        if (is_null($projects) || $projects->isEmpty()) {
            return [];
        }

        // Map each project to a structured array
        return $projects->map(function ($project) {
            // Ensure that all related data is not null
            $manager = $project->manager;
            $priority = $project->priorities;
            $status = $project->statuses;
            $members = $project->team_members;
            $tasks = $project->tasks;


            // Map tasks to members
            $membersTasks = $members->mapWithKeys(function ($member) use ($tasks) {
                // Get the username from the member's user relation
                $username = $member->user->username;

                // Filter tasks assigned to the current member by user_id
                $tasksForMember = $tasks->filter(function ($task) use ($member) {
                    return $task->user_id === $member->user_id;
                });

                // Return the tasks mapped by member's username
                return [
                    $username => $tasksForMember->map(function ($task) {
                        return [
                            'task_id' => $task->id,
                            'task_description' => $task->description,
                            'due_date' => $task->due_date,
                            'priority' => $task->priorities->priority_name,
                            'status' => $task->statuses->status,
                            'comments' => $task->comments
                        ];
                    })->toArray()
                ];
            })->toArray();

            // Ensure all members are included, even if they have no tasks
            $membersTasks = $members->mapWithKeys(function ($member) use ($membersTasks) {
                $username = $member->user->username;
                return [
                    $username => $membersTasks[$username] ?? [] // Add an empty array if no tasks exist
                ];
            })->toArray();

            // Return the structured project data
            return [
                'id' => $project->id,
                'project_name' => $project->project_name,
                'deadline' => $project->deadline,
                'project_manager_id' => $manager?->id,
                'project_manager' => $manager?->username,
                'project_manager_email' => $manager?->email,
                'priority_id' => $project->priority_id,
                'project_priority' => $priority?->priority_name,
                'status_id' => $project->status_id,
                'status' => $status?->status,
                'team_tasks' => $membersTasks,
            ];
        })->toArray();
    }

    public function show($id)
    {
        return $this->project_contract->show($id);
    }

    public function showProjectWithRelations($id)
    {
        $projects = $this->project_contract->showProjectWithRelations($id);

        // If no projects are found or the result is null, return an empty array
        if (is_null($projects) || $projects->isEmpty()) {
            return null;
        }

        $manager = $projects[0]->manager;
        $priority = $projects[0]->priorities;
        $status = $projects[0]->statuses;
        $members = $projects[0]->team_members;
        $tasks = $projects[0]->tasks;

        $membersTasks = $members->mapWithKeys(function ($member) use ($tasks) {
            // Get the username from the member's user relation
            $username = $member->user->username;

            // Filter tasks assigned to the current member by user_id
            $tasksForMember = $tasks->filter(function ($task) use ($member) {
                return $task->user_id === $member->user_id;
            });

            // Return the tasks mapped by member's username
            return [
                $username => $tasksForMember->map(function ($task) {
                    return [
                        'task_id' => $task->id,
                        'task_description' => $task->description,
                        'due_date' => $task->due_date,
                        'priority' => $task->priorities->priority_name,
                        'status' => $task->statuses->status,
                        'comments' => $task->comments
                    ];
                })->toArray()
            ];
        })->toArray();
        
        // Ensure all members are included, even if they have no tasks
        $membersTasks = $members->mapWithKeys(function ($member) use ($membersTasks) {
            $username = $member->user->username;
            return [
                $username => $membersTasks[$username] ?? [] // Add an empty array if no tasks exist
            ];
        })->toArray();

        return [
            'id' => $projects[0]->id,
            'project_name' => $projects[0]->project_name,
            'deadline' => $projects[0]->deadline,
            'project_manager_id' => $manager?->id,
            'project_manager' => $manager?->username,
            'project_manager_email' => $manager?->email,
            'priority_id' => $projects[0]->priority_id,
            'project_priority' => $priority?->priority_name,
            'status_id' => $projects[0]->status_id,
            'status' => $status?->status,
            'team_tasks' => $membersTasks,
        ];
    }
}