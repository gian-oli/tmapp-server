<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ResponseTrait;

    protected $task_service;

    public function __construct(TaskService $task_service)
    {
        $this->task_service = $task_service;
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
    public function store(TaskRequest $request)
    {
        $result = $this->successResponse('Task Stored Successfully');
        try {
            $data = [

                'description' => $request->description,
                'due_date' => $request->due_date,
                'priority_id' => $request->priority_id,
                'user_id' => $request->user_id,  #assigned to,
                'project_id' => $request->project_id, #which project it belongs to,
                'assigned_by' => $request->assigned_by, #who assigned the project, only use email
                'status_id' => $request->status_id
            ];
            $result['data'] = $this->task_service->store($data);
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
        $result = $this->successResponse('Task Loaded Successfully');
        try {
            $result['data'] = $this->task_service->show($id);
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
