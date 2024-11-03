<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $guarded=[];

    
    public function getImageAttribute($value)
    {

        if($value){
            return $value;
        }else{

            return 'default.png';
        }
    }

    public function setMobileAttribute($value)
    {
        $this->attributes['mobile'] = "+88".$value;
    }
}
