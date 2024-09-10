<?php

namespace App\Repositories;
use App\Models\Swimlane;
use App\Repositories\Contracts\SwimlaneContract;

class SwimlaneRepository extends BaseRepository implements SwimlaneContract {
    protected $model;

    public function __construct(Swimlane $model){
        $this->model = $model;
    }
}