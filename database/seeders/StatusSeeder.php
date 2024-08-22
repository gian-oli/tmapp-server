<?php

namespace Database\Seeders;

use App\Services\StatusService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    protected $status_service;
    public function __construct(StatusService $user_service){
        $this->status_service = $user_service;
    }
    public $statuses = [
        [
            "status" => "Pending"
        ],
        [
            "status" => "Ongoing"
        ],
        [
            "status" => "Finished"
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->statuses as $status){
            $this->status_service->store($status);
        }
    }
}
