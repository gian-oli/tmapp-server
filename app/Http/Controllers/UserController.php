<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */

    protected $user_service;

    public function __construct(UserService $user_service){
        $this->user_service = $user_service;
    }

    public function index()
    {
        $result = $this->successResponse("Users Loaded Successfully");
        try {
            $result['data'] = $this->user_service->loadUserWithRole();
        } catch (\Exception $e){
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $result = $this->successResponse("User Stored Successfully");
        try {
            $data = [
                'username' => $request->username,
                'password' => $request->password,
                'role_id' => $request->role_id,
                'email' => $request->email
            ];
            $result['data'] = $this->user_service->store($data);
        } catch (\Exception $e){
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
