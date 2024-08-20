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
        return $this->model->where('id', $id)->get();
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
        return $this->model->with(['manager', 'tasks.comments', 'team_members', 'priorities'])->get();
    }
    ##team-members
    public function showProjectMembers($id)
    {
        return $this->model->with(['user'])->where('project_id', $id)->get();
    }
    ##tasks
    public function showTasksWithRelation($id)
    {
        return $this->model->with(['user', 'priorities', 'comments', 'project'])->where('project_id', $id)->get();
    }
}