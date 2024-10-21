<?php

namespace App\Services;

use App\Repositories\Contracts\ScheduleContract;

class ScheduleService
{
    protected $schedule_contract;

    public function __construct(ScheduleContract $schedule_contract)
    {
        $this->schedule_contract = $schedule_contract;
    }

    public function load()
    {
        return $this->schedule_contract->load();
    }
    public function store($data)
    {
        return $this->schedule_contract->store($data);
    }
    public function update($id, $data)
    {
        return $this->schedule_contract->update($id, $data);
    }

    public function show($id)
    {
        return $this->schedule_contract->show($id);
    }
    public function showSchedulesWithRelations($id)
    {
        return $this->schedule_contract->showSchedulesWithRelations($id);
    }
}
