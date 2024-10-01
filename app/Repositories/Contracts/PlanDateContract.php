<?php

namespace App\Repositories\Contracts;

interface PlanDateContract {
    public function store($data);
    public function load();
}