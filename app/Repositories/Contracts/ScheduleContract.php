<?php

namespace App\Repositories\Contracts;

interface ScheduleContract {
    public function load();
    public function store($data);
    public function update($id, $data);
    public function show($id);
}