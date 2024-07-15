<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Employee;

class Leave extends Model
{
    protected $guarded = [];

    use SoftDeletes;
    use HasFactory;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $fillable =[
    //     "date", "deleted_at",
    // ];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
