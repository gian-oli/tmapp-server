<?php

namespace App\Services;
use App\Repositories\Contracts\SwimlaneContract;

class SwimlaneService
{
    protected $swimlane_contract;

    public function __construct(SwimlaneContract $swimlane_contract)
    {
        $this->swimlane_contract = $swimlane_contract;
    }

    public function store($data)
    {
        return $this->swimlane_contract->store($data);
    }

    public function delete($id)
    {
        return $this->swimlane_contract->delete($id);
    }

    public function showSwimlane($id)
    {
        return $this->swimlane_contract->showSwimlane($id);
    }

    public function showSwimlaneColumns($id)
    {
        return collect($this->swimlane_contract->showSwimlane($id))->map(function($swimlane) {
            return [
                $swimlane->id
            ];
        });
    }
}