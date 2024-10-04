<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualDateRequest;
use App\Services\ActualDateService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ActualDateController extends Controller
{
    use ResponseTrait;
    protected $actual_date_service;
    public function __construct(ActualDateService $actual_date_service)
    {
        $this->actual_date_service = $actual_date_service;
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
        $result = $this->successResponse('Actual date remove successfully');
        try {
            $result['data'] = $this->actual_date_service->delete($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }
}
