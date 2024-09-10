<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;
    protected $fillable = [
        'column_name',
        'swimlane_id'
    ];

    protected $guarded = ['id'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'column_id');
    }

    public function swimlanes()
    {
        return $this->belongsTo(Swimlane::class, 'swimlane_id');
    }
}
