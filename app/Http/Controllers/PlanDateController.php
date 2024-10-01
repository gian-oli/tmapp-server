<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanDateRequest;
use App\Services\PlanDateService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PlanDateController extends Controller
{
    use ResponseTrait;

    protected $plan_date_service;
    public function __construct(PlanDateService $plan_date_service)
    {
        $this->plan_date_service = $plan_date_service;
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
