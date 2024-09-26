<?php

namespace App\Repositories;
use App\Models\GanttChart;
use App\Repositories\Contracts\GanttChartContract;

class GanttChartRepository extends BaseRepository implements GanttChartContract {
    protected $model;

    public function __construct(GanttChart $model){
        $this->model = $model;
    }
}