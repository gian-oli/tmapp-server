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
        return $this->project_contract->loadProjectWithRelations();
    }

    public function show($id)
    {
        return $this->project_contract->show($id);
    }

    public function showProjectWithRelations($id)
    {
        $projects = $this->project_contract->showProjectWithRelations($id);
        if(!$projects[0]){
            throw new \Exception("No data found");
        }
        return $projects[0];
    }

    public function loadMyProjects($id){
        return $this->project_contract->loadMyProjects($id);
    }
}