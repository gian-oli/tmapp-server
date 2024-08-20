<?php

namespace App\Repositories;
use App\Models\Project;
use App\Repositories\Contracts\ProjectContract;

class ProjectRepository extends BaseRepository implements ProjectContract {
    protected $model;

    public function __construct(Project $model){
        $this->model = $model;
    }
}