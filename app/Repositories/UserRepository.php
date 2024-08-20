<?php

namespace App\Repositories;
use App\Models\User;
use App\Repositories\Contracts\UserContract;

class UserRepository extends BaseRepository implements UserContract {
    protected $model;

    public function __construct(User $model){
        $this->model = $model;
    }
}