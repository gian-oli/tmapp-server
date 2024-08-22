<?php

namespace App\Services;
use App\Repositories\Contracts\StatusContract;

class StatusService {
    protected $status_contract;

    public function __construct(StatusContract $status_contract){
        $this->status_contract = $status_contract;
    }

    public function store($data)
    {
        return $this->status_contract->store($data);
    }
}