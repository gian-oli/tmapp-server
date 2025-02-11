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
    public function loadMyProjects($id);
    ##tasks
    public function showTasksWithRelation($id);
    // public function assignMember($id, $data);
    ##team-members
    public function showProjectMembers($id);
    ##column
    public function backlogColumn($id);
    public function columnTasks($id);
    public function getTasksByColumnAndUser($column_id, $user_id);
    ##swimlanes
    public function showSwimlane($id);
    ##gantt chart
    public function getGanttChart();
    ##actual dates
    public function showActualDates($schedule_id);
    ##schedules
    public function showSchedulesWithRelations($id);
}
