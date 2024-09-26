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
        'percent_completed'
    ];

    protected $guarded = ['id'];
    public function project()
    {
        return $this->hasOne(Project::class, 'gantt_chart_id', 'id');
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'gantt_chart_id', 'id');
    }
    public function target_date()
    {
        return $this->hasOne(TargetDate::class, 'gantt_chart_id', 'id');
    }
    public function total_duration()
    {
        return $this->hasOne(TotalDuration::class, 'gantt_chart_id', 'id');
    }
}
