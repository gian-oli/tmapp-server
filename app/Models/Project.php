<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal',
        'deadline',
        'user_id', // project manager
        'priority_id'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team_members()
    {
        return $this->hasMany(TeamMember::class, 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function priorities()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }
}
