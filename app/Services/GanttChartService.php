<?php

namespace App\Services;
use App\Repositories\Contracts\GanttchartContract;

class GanttChartService {
    protected $gantt_chart_contract;

    public function __construct(GanttchartContract $gantt_chart_contract){
        $this->gantt_chart_contract = $gantt_chart_contract;
    }
}