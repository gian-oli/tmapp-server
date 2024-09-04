<?php

namespace App\Repositories\Contracts;

interface PriorityContract {
    public function load();
    public function store($data);
}