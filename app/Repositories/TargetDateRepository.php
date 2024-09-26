<?php

namespace App\Repositories;
use App\Models\TargetDate;
use App\Repositories\Contracts\TargetDateContract;

class TargetDateRepository extends BaseRepository implements TargetDateContract {
    protected $model;

    public function __construct(TargetDate $model){
        $this->model = $model;
    }
}