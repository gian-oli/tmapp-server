<?php

namespace App\Repositories\Contracts;

interface TeamMemberContract {
    public function store($data);
    public function showProjectMembers($id);
}