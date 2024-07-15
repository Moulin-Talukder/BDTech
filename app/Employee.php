<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // protected $fillable =[
    //     "name", "image", "department_id", "email", "phone_number",
    //     "user_id", "address", "city", "country", "is_active"
    // ];
    protected $guarded = ["user"];

    protected $table = 'employees';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','date'];
    public function payroll()
    {
    	return $this->hasMany('App\Payroll');
    }
    
}
