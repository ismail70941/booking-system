<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'title',
        'room',
        'start_time',
        'end_time',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function participants()
    {
        return $this->belongsToMany(Employee::class, 'booking_employee');
    }
}
