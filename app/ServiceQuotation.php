<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceQuotation extends Model
{
    use HasFactory; 
 
    protected $table = 'service_quotations';

    protected $fillable = [

        "quotation_no",    "date",    "delivary_date",    "reference_no",    "user_id",    "supplier_id",    "customer_id",    "warehouse_id",    "item",    "total_qty", "total_discount",    "total_vat",    "total_price",    "order_tax_rate",    "order_tax",    "order_discount",    "shipping_cost",    "grand_total",    "quotation_status",    "document",    "note",
        "bareer_name", "designation", "description", "p_sl", "purpose", "bd_sl",'warranty'



    ];

    public function biller()
    {
        return $this->belongsTo('App\Biller');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }

    public function services(){
        return $this->hasMany('App\ServicesQuotations','service_quotations_id','id');
    }



}
