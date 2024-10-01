<?php

namespace App\Repositories;
use App\Models\PlanDate;
use App\Repositories\Contracts\PlanDateContract;

class PlanDateRepository extends BaseRepository implements PlanDateContract {
    protected $model;

    public function __construct(PlanDate $model){
        $this->model = $model;
    }
}