<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Column;
use App\Services\ColumnService;
use App\Services\TaskService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ResponseTrait;

    protected $task_service;
    protected $column_service;

    public function __construct(TaskService $task_service, ColumnService $column_service)
    {
        $this->task_service = $task_service;
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
    public function store(TaskRequest $request)
    {
        $result = $this->successResponse('Task Stored Successfully');
        try {
            $backlogColumn = $this->column_service->backlogColumn($request->swimlane_id);
            if (!$backlogColumn) {
                throw new \Exception('Backlog column not found for the specified swimlane.');
            }
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'priority_id' => $request->priority_id,
                'finished_at' => $request->finished_at || null,
                'user_id' => $request->user_id,  #assigned to,
                'assigned_by' => $request->assigned_by, #who assigned the project, only use email
                'column_id' => $backlogColumn->id
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
    public function assignMember(Request $request, string $id)
    {
        $result = $this->successResponse('Task Updated Successfully');
        try {
            $result['data'] = $this->task_service->update($id, ["user_id" => $request->user_id]);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    public function changeColumn(Request $request, string $id)
    {
        $result = $this->successResponse('Task Updated Successfully');
        try {
            $result['data'] = $this->task_service->update($id, ["column_id" => $request->column_id]);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    // public function assignSwimlane(Request $request, string $id)
    // {
    //     $result = $this->successResponse('Task Updated Successfully');
    //     try {
    //         $result['data'] = $this->task_service->update($id, ["column_id" => $request->column_id]);
    //     } catch (\Exception $e) {
    //         $result = $this->errorResponse($e);
    //     }
    //     return $this->returnResponse($result);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
