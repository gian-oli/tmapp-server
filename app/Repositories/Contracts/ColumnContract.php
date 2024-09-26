<?php

namespace App\Repositories\Contracts;

interface ColumnContract {
    public function store($data);
    public function backlogColumn($id);
    public function columnTasks($id);
}