<?php

namespace App\Repositories\Contracts;

interface RoleContract {
    public function load();
    public function store($data);
}