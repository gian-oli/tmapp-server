<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'due_date',
        'priority_id',
        'user_id',
        'project_id',
        'assigned_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function priorities()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
