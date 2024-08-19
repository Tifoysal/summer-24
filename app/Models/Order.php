<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function orderDetails()
    {
    
        return $this->hasMany(OrderDetail::class);
    }

  
    public function customer()
    {
        return $this->belongsTo(Customer::class);    
    }
}
