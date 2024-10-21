<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanDateRequest;
use App\Services\PlanDateService;
use App\Services\ScheduleService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PlanDateController extends Controller
{
    use ResponseTrait;

    protected $plan_date_service;
    protected $schedule_service;
    public function __construct(PlanDateService $plan_date_service, ScheduleService $schedule_service)
    {
        $this->plan_date_service = $plan_date_service;
        $this->schedule_service = $schedule_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->successResponse('Plan Date Successfully Loaded');
        try {
            $result['data'] = $this->plan_date_service->load();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanDateRequest $request)
    {
        $result = $this->successResponse('Plan Date Stored Successfully');
        try {
            $data = [
                'date' => $request->date,
                'time_spent' => $request->time_spent,
                'schedule_id' => $request->schedule_id
            ];
            $this->plan_date_service->store($data);
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
        $result = $this->successResponse('Plan Date Updated Successfully');
        $schedule_data = $this->schedule_service->showSchedulesWithRelations($id);
        $plan_dates = [];
        try {
            if (count($schedule_data['plan_dates']) > 0) {
                $plan_dates = collect($schedule_data['plan_dates'])->map(function ($plan) {
                    return [
                        'id' => $plan->id,
                        'date' => $plan->date
                    ];
                });
                foreach ($plan_dates as $plan) {
                    $this->destroy($plan['id']);
                }
            }
            foreach ($request->dates as $date) {
                $data = [
                    'date' => $date,
                    'time_spent' => 8.75,
                    'schedule_id' => $id
                ];
                $result['data'][] =  $this->plan_date_service->store($data);
            }
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->successResponse('Plan date successfully removed');
        try {
            $result['data'] = $this->plan_date_service->delete($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }
}
