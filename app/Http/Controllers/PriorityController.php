<?php

namespace App\Http\Controllers;

use App\Services\PriorityService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriorityController extends Controller
{
    use ResponseTrait;

    protected $priority_service;

    public function __construct(PriorityService $priority_service)
    {
        $this->priority_service = $priority_service;
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
            $result['data'] = $this->priority_service->load();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
