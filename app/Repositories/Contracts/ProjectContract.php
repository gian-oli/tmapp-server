<?php

namespace App\Repositories\Contracts;

interface ProjectContract {
    public function store($data);
    public function loadProjectWithRelations();
    public function show($id);
}