<?php

namespace App\Repositories\Contracts;

interface SwimlaneContract {
    public function store($data);
    public function delete($id);
    public function showSwimlane($id);
}