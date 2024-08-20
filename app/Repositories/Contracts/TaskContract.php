<?php

namespace App\Repositories\Contracts;

interface TaskContract {
    public function store($data);
    public function showTasksWithRelation($id);
}