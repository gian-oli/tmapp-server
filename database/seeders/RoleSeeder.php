<?php

namespace Database\Seeders;

use App\Services\RoleService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected $role_service;

    public function __construct(RoleService $role_service)
    {
        $this->role_service = $role_service;
    }

    public $roles = [
        [
            "role_name" => "Admin"
        ],
        [
            "role_name" => "Member",
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $role) {
            $this->role_service->store($role);
        }
    }
}
