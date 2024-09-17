<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwimlaneRequest;
use App\Services\SwimlaneService;
use App\Traits\ResponseTrait;
use Database\Seeders\ColumnSeeder;
use Illuminate\Http\Request;

class SwimlaneController extends Controller
{
    use ResponseTrait;

    protected $swimlane_service;
    public function __construct(SwimlaneService $swimlane_service)
    {
        $this->swimlane_service = $swimlane_service;
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
    public function store(SwimlaneRequest $request)
{
    $result = $this->successResponse('Swimlane successfully created');
    try {
        $data = [
            "swimlane_name" => $request->swimlane_name,
            "project_id" => $request->project_id,
        ];

        // Store the swimlane
        $swimlane = $this->swimlane_service->store($data);

        // Trigger the ColumnSeeder with the newly created swimlane's ID
        $columnSeeder = new ColumnSeeder($swimlane->id);
        $columnSeeder->run();

        // Attach the swimlane data to the result
        $result['data'] = $swimlane;
    } catch (\Exception $e) {
        $result = $this->errorResponse('Failed to create swimlane');
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
        $result = $this->successResponse('Successfully removed swimlane');
        try {
            $this->swimlane_service->delete($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse('Failed to remove swimlane');
        }
        return $this->returnResponse($result);
    }
}
