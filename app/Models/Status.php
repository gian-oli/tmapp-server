<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_name'
    ];

    protected $guarded = ['id'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'status_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
