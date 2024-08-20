<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;
    protected $fillable = [
        'priority_name'
    ];

    protected $guarded = ['id'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'priority_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'priority_id');
    }
}
