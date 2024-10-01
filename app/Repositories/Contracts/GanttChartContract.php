<?php

namespace App\Repositories\Contracts;

interface GanttChartContract {
    public function load();
    public function store($data);
    public function getGanttchart();
}