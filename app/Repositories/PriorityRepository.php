<?php

namespace App\Repositories;
use App\Models\Priority;
use App\Repositories\Contracts\PriorityContract;

class PriorityRepository extends BaseRepository implements PriorityContract {
    protected $model;

    public function __construct(Priority $model){
        $this->model = $model;
    }
}