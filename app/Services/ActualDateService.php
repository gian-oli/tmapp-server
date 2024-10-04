<?php

namespace App\Services;
use App\Repositories\Contracts\ActualDateContract;

class ActualDateService {
    protected $actual_date_contract;

    public function __construct(ActualDateContract $actual_date_contract){
        $this->actual_date_contract = $actual_date_contract;
    }

    public function load()
    {
        return $this->actual_date_contract->load();
    }
    public function store($data)
    {
        return $this->actual_date_contract->store($data);
    }
    public function delete($id)
    {
        return $this->actual_date_contract->delete($id);
    }
}