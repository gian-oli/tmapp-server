<?php

namespace App\Repositories;
use App\Models\Status;
use App\Repositories\Contracts\StatusContract;

class StatusRepository extends BaseRepository implements StatusContract {
    protected $model;

    public function __construct(Status $model){
        $this->model = $model;
    }
}