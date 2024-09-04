<?php

namespace App\Services;
use App\Repositories\Contracts\PriorityContract;

class PriorityService {
    protected $priority_contract;

    public function __construct(PriorityContract $priority_contract){
        $this->priority_contract = $priority_contract;
    }

    public function load()
    {
        return $this->priority_contract->load();
    }

    public function store($data)
    {
        return $this->priority_contract->store($data);
    }
}