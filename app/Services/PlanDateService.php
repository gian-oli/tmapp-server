<?php

namespace App\Services;
use App\Repositories\Contracts\PlanDateContract;

class PlanDateService
{
    protected $plan_date_contract;

    public function __construct(PlanDateContract $plan_date_contract)
    {
        $this->plan_date_contract = $plan_date_contract;
    }

    public function load()
    {
        return $this->plan_date_contract->load();
    }

    public function store($data)
    {
        return $this->plan_date_contract->store($data);
    }
}