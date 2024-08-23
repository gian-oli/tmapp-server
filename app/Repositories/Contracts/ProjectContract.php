<?php

namespace App\Repositories\Contracts;

interface ProjectContract {
    public function store($data);
    public function load();
    public function loadProjectWithRelations();
    public function show($id);
    public function showProjectWithRelations($id);
}