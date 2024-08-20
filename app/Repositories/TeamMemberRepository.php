<?php

namespace App\Repositories;
use App\Models\TeamMember;
use App\Repositories\Contracts\TeamMemberContract;

class TeamMemberRepository extends BaseRepository implements TeamMemberContract {
    protected $model;

    public function __construct(TeamMember $model){
        $this->model = $model;
    }
}