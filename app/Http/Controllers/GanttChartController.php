<?php

namespace App\Http\Controllers;

use App\Http\Requests\GanttChartRequest;
use App\Services\GanttChartService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class GanttChartController extends Controller
{
    use ResponseTrait;

    protected $gantt_chart_service;
    public function __construct(GanttChartService $gantt_chart_service)
    {
        $this->gantt_chart_service = $gantt_chart_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->successResponse('Gantt Chart Load Successfully');
        try {
            $result['data'] = $this->gantt_chart_service->getGanttChart();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GanttChartRequest $request)
    {
        $result = $this->successResponse('Gantt Chart Successfully Stored');
        try {
            $data = [
                "name" => $request->name,
                "status" => $request->status,
                "date_from" => $request->date_from,
                "date_to" => $request->date_to,
                "percent_completed" => $request->percent_completed
            ];
            $result['data'] = $this->gantt_chart_service->store($data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
