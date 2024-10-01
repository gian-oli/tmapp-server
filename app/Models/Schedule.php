<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'percent_completed',
        'plan_start_date',
        'plan_end_date',
        'plan_no_of_days',
        'actual_start_date',
        'actual_end_date',
        'actual_no_of_days',
        'gantt_chart_id',
        'user_id'
    ];
    protected $guarded = ['id'];

    public function ganttChart()
    {
        return $this->belongsTo(GanttChart::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'schedule_id', 'id');
    }
    public function actual_dates()
    {
        return $this->hasMany(ActualDate::class, 'schedule_id', 'id');
    }
    public function plan_dates()
    {
        return $this->hasMany(PlanDate::class, 'schedule_id', 'id');
    }
}
