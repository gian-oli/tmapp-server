<?php

namespace App\Repositories\Contracts;

interface ScheduleContract {
    public function load();
    public function store($data);
}