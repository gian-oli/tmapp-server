<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swimlane extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'swimlane_name',
        'project_id'
    ];

    protected $guarded = ['id'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'swimlane_id', 'id');
    }

    public function columns()
    {
        return $this->hasMany(Column::class, 'swimlane_id', 'id');
    }
    
}
