<?php

namespace App\Repositories;
use App\Models\Schedule;
use App\Repositories\Contracts\ScheduleContract;

class ScheduleRepository extends BaseRepository implements ScheduleContract {
    protected $model;

    public function __construct(Schedule $model){
        $this->model = $model;
    }
}