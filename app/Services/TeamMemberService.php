<?php

namespace App\Services;
use App\Repositories\Contracts\TeamMemberContract;

class TeamMemberService {
    protected $team_member_contract;

    public function __construct(TeamMemberContract $team_member_contract){
        $this->team_member_contract = $team_member_contract;
    }

    public function store($data)
    {
        return $this->team_member_contract->store($data);
    }
    
    public function show($id)
    {
        $members = $this->team_member_contract->showProjectMembers($id);
        // return $members;
        return $members->map(function($member) {
            return [
                "id" => $member->id,
                "user_id" => $member->user_id,
                "project_id" => $member->project_id,
                "username" => $member->user->username,
                "email" => $member->user->email
            ];
        });
    }
}