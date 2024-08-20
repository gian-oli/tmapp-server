<?php

namespace App\Repositories\Contracts;

interface UserContract {
    public function show($id);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
    public function loadUserWithRole();
}