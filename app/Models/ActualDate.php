<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'note',
        'time_spent',
        'schedule_id'
    ];
    protected $guarded = ['id'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
}
