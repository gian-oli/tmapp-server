<?php

namespace App\Repositories\Contracts;

interface ActualDateContract {
    public function store($data);
    public function load();
    public function show($id);
    public function delete($id);
    public function showActualDates($schedule_id);
}