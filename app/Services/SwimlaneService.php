<?php

namespace App\Services;
use App\Repositories\Contracts\SwimlaneContract;

class SwimlaneService {
    protected $swimlane_contract;

    public function __construct(SwimlaneContract $swimlane_contract){
        $this->swimlane_contract = $swimlane_contract;
    }

    public function store($data)
    {
        return $this->swimlane_contract->store($data);
    }
    
    public function show($id)
    {
        return $this->swimlane_contract->show($id);
    }

    public function delete($id)
    {
        return $this->swimlane_contract->delete($id);
    }
}