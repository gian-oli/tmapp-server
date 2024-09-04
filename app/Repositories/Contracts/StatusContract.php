<?php

namespace App\Repositories\Contracts;

interface StatusContract {
    public function load();
    public function store($data);
}