<?php

namespace App\Services;
use App\Repositories\Contracts\TargetDateContract;

class TargetDateService {
    protected $target_date_contract;

    public function __construct(TargetDateContract $target_date_contract){
        $this->target_date_contract = $target_date_contract;
    }
}