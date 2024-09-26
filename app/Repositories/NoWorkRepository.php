<?php

namespace App\Repositories;
use App\Models\NoWork;
use App\Repositories\Contracts\NoWorkContract;

class NoWorkRepository extends BaseRepository implements NoWorkContract {
    protected $model;

    public function __construct(NoWork $model){
        $this->model = $model;
    }
}