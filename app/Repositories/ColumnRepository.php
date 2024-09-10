<?php

namespace App\Repositories;
use App\Models\Column;
use App\Repositories\Contracts\ColumnContract;

class ColumnRepository extends BaseRepository implements ColumnContract {
    protected $model;

    public function __construct(Column $model){
        $this->model = $model;
    }
}