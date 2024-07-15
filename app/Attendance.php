<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class Attendance extends Model
{
    protected $fillable =[
        "date", "employee_id", "user_id",
        "time", "checkout", "status", "note","updated_by"
    ];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
