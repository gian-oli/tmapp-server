<?php

namespace App\Http\Controllers;

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
            $result['data'] = $this->gantt_chart_service->load();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->successResponse('Gantt Chart Successfully Stored');
       
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
