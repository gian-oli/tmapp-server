<?php

namespace Database\Seeders;

use App\Services\UserService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    protected $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public $users = [
        [
            "username" => "gian",
            "password" => "12345678",
            "role_id" => 1,
            "email" => "gianoliver.maaghop@gmail.com"
        ],
        [
            "username" => "mico",
            "password" => "12345678",
            "role_id" => 1,
            "email" => "mico.montanez@gmail.com"
        ],
        [
            "username" => "jonathan",
            "password" => "12345678",
            "role_id" => 1,
            "email" => "jonathandave.detorres@gmail.com"
        ],
        [
            "username" => "reina",
            "password" => "12345678",
            "role_id" => 1,
            "email" => "reinamae.sorisantos@gmail.com"
        ],
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->users as $user){
            $this->user_service->store($user);
        }
    }
}
