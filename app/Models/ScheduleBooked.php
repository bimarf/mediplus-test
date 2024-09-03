<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleBooked extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'clinic_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
