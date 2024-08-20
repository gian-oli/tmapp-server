<?php

namespace App\Services;
use App\Repositories\Contracts\ProjectContract;

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

    public function loadProjectWithRelations()
    {
        $projects = $this->project_contract->loadProjectWithRelations();

        if(!$projects) {
            return [];
        }

        // return $projects[0]->team_members;
        return $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'goal' => $project->goal,
                'deadline' => $project->deadline,
                'project_manager_id' => $project->manager->id,
                'project_manager' => $project->manager->username,
                'project_manager_email' => $project->manager->email,
                'tasks' => $project->tasks ?? [],
                'team_members' => $project->team_members ?? [],
                'priority_id' => $project->priority_id,
                'priority_name' => $project->priorities->priority_name
            ];
        })->toArray();
    }

    public function show($id)
    {
        return $this->project_contract->show($id);
    }

}