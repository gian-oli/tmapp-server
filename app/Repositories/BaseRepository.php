<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseContract;

abstract class BaseRepository implements BaseContract
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function load()
    {
        return $this->model->get();
    }
    public function show($id)
    {
        return $this->model->where('id', $id)->first();
    }
    public function store($data)
    {
        return $this->model->create($data);
    }
    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }
    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }
    ##users
    public function loadUserWithRole()
    {
        return $this->model->with(['roles'])->get();
    }
    ##projects
    public function loadProjectWithRelations()
    {
        return $this->model
            ->with([
                'manager',
                'swimlanes.columns.tasks',
                'team_members.user',
                'priorities',
                'statuses'
            ])
            ->get();
    }
    public function showProjectWithRelations($id)
    {
        return $this->model
            ->with([
                'manager',
                'swimlanes.columns.tasks.comments',
                'swimlanes.columns.tasks.priorities',
                'swimlanes.columns.tasks.user',
                'team_members.user',
                'priorities',
                'statuses'
            ])
            ->where('id', $id)
            ->get();
    }
    public function loadMyProjects($id)
    {
        return $this->model
            ->whereHas('team_members', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->get();
    }
    ##team-members
    public function showProjectMembers($id)
    {
        return $this->model->with(['user'])->where('project_id', $id)->get();
    }
    ##tasks
    public function showTasksWithRelation($id)
    {
        return $this->model->with(['user', 'priorities', 'comments', 'project', 'statuses'])->where('project_id', $id)->get();
    }
    ##column
    public function backlogColumn($id)
    {
        return $this->model->where('swimlane_id', $id)
            ->where('column_name', 'Backlog')
            ->first();
    }
    public function columnTasks($id)
    {
        return $this->model
            ->where('id', $id)
            ->with('tasks')
            ->first();
    }
    public function getTasksByColumnAndUser($column_id, $user_id)
    {
        return $this->model
            ->where([['column_id', $column_id],['user_id', $user_id]])
            ->get();
    }
    ##swimlanes
    public function showSwimlane($id)
    {
        return $this->model
            ->with(['columns.tasks'])
            ->where('id', $id)
            ->first();
    }
    ##gantt chart
    public function getGanttChart()
    {
        return $this->model
            ->with(['schedules.users', 'schedules.project'])
            ->get();
    }
}
