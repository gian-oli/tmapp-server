<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualDateRequest;
use App\Services\ActualDateService;
use App\Services\ScheduleService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ActualDateController extends Controller
{
    use ResponseTrait;
    protected $actual_date_service;
    protected $schedule_service;
    public function __construct(ActualDateService $actual_date_service, ScheduleService $schedule_service)
    {
        $this->actual_date_service = $actual_date_service;
        $this->schedule_service = $schedule_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->successResponse('Load Successfully');
        try {
            $result['data'] = $this->actual_date_service->load();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActualDateRequest $request)
    {
        $result = $this->successResponse('Actual Date Stored Successfully');
        try {
            $data = [
                'date' => $request->date,
                'note' => $request->note,
                'time_spent' => $request->time_spent,
                'schedule_id' => $request->schedule_id
            ];
            $result['data'] = $this->actual_date_service->store($data);
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
        $result = $this->successResponse('Actual Date Load Successfully');
        try {
            $result['data'] = $this->actual_date_service->show($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->successResponse('Actual Date Updated Successfully');
        $schedule_data = $this->schedule_service->showSchedulesWithRelations($id);
        $actual_dates = [];
        try {
            if (count($schedule_data['actual_dates']) > 0) {
                $actual_dates = collect($schedule_data['actual_dates'])->map(function ($actual) {
                    return [
                        'id' => $actual->id,
                        'date' => $actual->date
                    ];
                });
                foreach ($actual_dates as $actual) {
                    $this->destroy($actual['id']);
                }
            }
            foreach ($request->dates as $date) {
                $data = [
                    'date' => $date,
                    'time_spent' => 8.75,
                    'schedule_id' => $id
                ];
                $result['data'][] =  $this->actual_date_service->store($data);
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
        $result = $this->successResponse('Actual date remove successfully');
        try {
            $result['data'] = $this->actual_date_service->delete($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }
}
