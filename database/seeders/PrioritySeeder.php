<?php

namespace Database\Seeders;

use App\Services\PriorityService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    protected $priority_service;
    public function __construct(PriorityService $priority_service)
    {
        $this->priority_service = $priority_service;
    }

    public $priorities = [
        [
            "priority_name" => "Low"
        ],
        [
            "priority_name" => "Middle"
        ],
        [
            "priority_name" => "High"
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->priorities as $priority) {
            $this->priority_service->store($priority);
        }
    }
}
