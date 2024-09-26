<?php

namespace App\Services;
use App\Repositories\Contracts\NoWorkContract;

class NoWorkService {
    protected $no_work_contract;

    public function __construct(NoWorkContract $no_work_contract){
        $this->no_work_contract = $no_work_contract;
    }
}