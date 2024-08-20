<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamMemberRequest;
use App\Services\TeamMemberService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    use ResponseTrait;

    protected $team_member_service;

    public function __construct(TeamMemberService $team_member_service)
    {
        $this->team_member_service = $team_member_service;
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
    public function store(TeamMemberRequest $request)
    {
        $result = $this->successResponse('Team Member Added Successfully');
        try {
            $data = [
                'user_id' => $request->user_id,
                'project_id' => $request->project_id
            ];
            $result['data'] = $this->team_member_service->store($data);
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
        $result = $this->successResponse('Team Member Loaded Successfully');
        try {
            $result['data'] = $this->team_member_service->show($id);
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
