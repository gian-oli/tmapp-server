<?php

namespace App\Services;
use App\Repositories\Contracts\TotalDurationContract;

class TotalDurationService {
    protected $total_duration_contract;

    public function __construct(TotalDurationContract $total_duration_contract){
        $this->total_duration_contract = $total_duration_contract;
    }
}