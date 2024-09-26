<?php

namespace App\Services;
use App\Repositories\Contracts\ScheduleContract;

class ScheduleService {
    protected $schedule_contract;

    public function __construct(ScheduleContract $schedule_contract){
        $this->schedule_contract = $schedule_contract;
    }
}