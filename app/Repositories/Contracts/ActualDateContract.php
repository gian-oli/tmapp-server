<?php

namespace App\Repositories\Contracts;

interface ActualDateContract {
    public function store($data);
    public function load();
}