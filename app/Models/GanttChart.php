<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GanttChart extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'date_from',
        'date_to',
        'percent_completed'
    ];

    protected $guarded = ['id'];
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'gantt_chart_id', 'id');
    }
}
