<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority_id',
        'user_id',
        'assigned_by',
        'column_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function priorities()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    public function columns()
    {
        return $this->belongsTo(Column::class, 'column_id');
    }
}
