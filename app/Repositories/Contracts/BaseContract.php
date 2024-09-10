<?php

namespace App\Repositories\Contracts;

interface BaseContract
{
    public function load();
    public function show($id);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
    ##users
    public function loadUserWithRole();
    ##projects
    public function loadProjectWithRelations();
    public function showProjectWithRelations($id);
    ##tasks
    public function showTasksWithRelation($id);
    // public function assignMember($id, $data);
    ##team-members
    public function showProjectMembers($id);
    ##column
    public function backlogColumn($id);

}