<?php

namespace App\Services;
use App\Repositories\Contracts\UserContract;

class UserService
{
    protected $user_contract;

    public function __construct(UserContract $user_contract)
    {
        $this->user_contract = $user_contract;
    }

    public function store($data)
    {
        return $this->user_contract->store($data);
    }
    public function loadUserWithRole()
    {
        $users = $this->user_contract->loadUserWithRole();

        return $users->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'role_name' => $user->roles->role_name 
            ];
        })->toArray();
    }

}