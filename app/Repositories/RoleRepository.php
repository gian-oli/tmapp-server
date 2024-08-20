<?php

namespace App\Repositories;
use App\Models\Role;
use App\Repositories\Contracts\RoleContract;

class RoleRepository extends BaseRepository implements RoleContract {
    protected $model;

    public function __construct(Role $model){
        $this->model = $model;
    }
    
}