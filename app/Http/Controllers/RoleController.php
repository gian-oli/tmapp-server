<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    use ResponseTrait;

    protected $role_service;

    public function __construct(RoleService $role_service)
    {
        $this->role_service = $role_service;
    }
    /**

     * Display a listing of the resource.
     */
    public function index()
    {
        // if (!Auth::check()) {
        //     return $this->errorResponse('Unauthorized');
        // }
        // $result = $this->successResponse('Loaded Projects Successfully');
        // try {
        //     $result['data'] = $this->role_service->load();
        // } catch (\Exception $e) {
        //     $result = $this->errorResponse($e);
        // }
        // return $this->returnResponse($result);
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
