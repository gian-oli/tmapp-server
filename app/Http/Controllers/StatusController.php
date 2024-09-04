<?php

namespace App\Http\Controllers;

use App\Services\StatusService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    use ResponseTrait;

    protected $status_service;

    public function __construct(StatusService $status_service)
    {
        $this->status_service = $status_service;
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
            $result['data'] = $this->status_service->load();
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
