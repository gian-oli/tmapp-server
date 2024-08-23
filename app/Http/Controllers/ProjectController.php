<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use ResponseTrait;

    protected $project_service;

    public function __construct(ProjectService $project_service)
    {
        $this->project_service = $project_service;
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return $this->errorResponse('Unauthorized');
        }
        $result = $this->successResponse('Loaded Projects Successfully');
        try {
            $result['data'] = $this->project_service->load();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }
    public function loadProjectWithRelations()
    {
        if (!Auth::check()) {
            return $this->errorResponse('Unauthorized');
        }
        $result = $this->successResponse('Loaded Projects Successfully');
        try {
            $result['data'] = $this->project_service->loadProjectWithRelations();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        if (!Auth::check()) {
            return $this->errorResponse('Unauthorized');
        }
        $result = $this->successResponse('Project Stored Successfully');
        try {
            $data = [
                "project_name" => $request->project_name,
                "deadline" => $request->deadline,
                "user_id" => $request->user_id,
                "priority_id" => $request->priority_id,
                "status_id" => $request->status_id
            ];
            $result['data'] = $this->project_service->store($data);
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
        if (!Auth::check()) {
            return $this->failedValidationResponse('Unauthorized');
        }
        $result = $this->successResponse('Project Loaded Successfully');
        try {
            $result['data'] = $this->project_service->show($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    public function showProjectWithRelations($id)
    {
        if(!Auth::check()){
            return $this->failedValidationResponse('Unauthorized');
        }
        $result = $this->successResponse('Project Loaded Successfully');
        try {
            $result['data'] = $this->project_service->showProjectWithRelations($id);
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
