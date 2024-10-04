<?php

namespace App\Services;
use App\Repositories\Contracts\RoleContract;

class RoleService {
    protected $role_contract;

    public function __construct(RoleContract $role_contract){
        $this->role_contract = $role_contract;
    }
    public function load(){
        return $this->role_contract->load();
    }
    public function store($data) {
        return $this->role_contract->store($data);
    }
}