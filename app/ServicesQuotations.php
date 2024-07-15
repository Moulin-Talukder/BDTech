<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesQuotations extends Model
{
    use HasFactory;

    protected $table = 'services_quotations';
  

    protected $fillable = ['service_quotations_id'];

    public function service($id){
        return Service::findOrFail($id);

    }
}
