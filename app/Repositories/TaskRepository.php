<?php

namespace App\Repositories;
use App\Models\Task;
use App\Repositories\Contracts\TaskContract;

class TaskRepository extends BaseRepository implements TaskContract {
    protected $model;

    public function __construct(Task $model){
        $this->model = $model;
    }
}