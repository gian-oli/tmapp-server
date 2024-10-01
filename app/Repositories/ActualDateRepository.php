<?php

namespace App\Repositories;
use App\Models\ActualDate;
use App\Repositories\Contracts\ActualDateContract;

class ActualDateRepository extends BaseRepository implements ActualDateContract {
    protected $model;

    public function __construct(ActualDate $model){
        $this->model = $model;
    }
}