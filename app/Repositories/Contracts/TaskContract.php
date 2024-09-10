<?php

namespace App\Repositories\Contracts;

interface TaskContract {
    public function store($data);
    public function show($id);
    public function update($id, $data);
    public function showTasksWithRelation($id);
    // public function assignMember($id, $data);
}