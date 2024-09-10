<?php

namespace App\Services;
use App\Repositories\Contracts\ColumnContract;

class ColumnService {
    protected $column_contract;

    public function __construct(ColumnContract $column_contract){
        $this->column_contract = $column_contract;
    }

    public function store($data)
    {
        return $this->column_contract->store($data);
    }
    
    public function backlogColumn($id)
    {
        return $this->column_contract->backlogColumn($id);
    }
}