<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColumnRequest;
use App\Services\ColumnService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    use ResponseTrait;
    protected $column_service;
    public function __construct(ColumnService $column_service)
    {
        $this->column_service = $column_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColumnRequest $request)
    {
        $result = $this->successResponse('Column Created Successfully');
        try {
            $data = [
                'column_name' => $request->column_name,
                'swimlane_id' => $request->swimlane_id
            ];
            $result['data'] = $this->column_service->store($data);
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
        $result = $this->successResponse('Column fetched Successfully');
        try {
            $result['data'] = $this->column_service->columnTasks($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    public function backlogToReady($swimlane_id, $column_id)
    {
        $result = $this->successResponse('Column Updated Successfully');
        try {
            $result['data'] = $this->column_service->backlogToReady($swimlane_id, $column_id);

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
