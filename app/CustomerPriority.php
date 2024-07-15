<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPriority extends Model
{
    protected $fillable = [
         "priority","note","is_active"
    ];
}
