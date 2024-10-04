<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Services\ScheduleService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use ResponseTrait;
    protected $schedule_service;
    public function __construct(ScheduleService $schedule_service)
    {
        $this->schedule_service = $schedule_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->successResponse('Schedule loaded successfully');
        try {
            $result['data'] = $this->schedule_service->load();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request)
    {
        $result = $this->successResponse('Schedule Stored Successly');
        try {
            $data = [
                'name' => $request->name,
                'status' => $request->status,
                'gantt_chart_id' => $request->gantt_chart_id,
                'user_id' => $request->user_id
            ];
            $result['data'] = $this->schedule_service->store($data);
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
