<?php

namespace App\Repositories;
use App\Models\TotalDuration;
use App\Repositories\Contracts\TotalDurationContract;

class TotalDurationRepository extends BaseRepository implements TotalDurationContract {
    protected $model;

    public function __construct(TotalDuration $model){
        $this->model = $model;
    }
}