<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function category()// relation name should be related to FK
    {

        //hasOne (1 to 1 optional)
        //belongsTo(1 to 1 mandatory)
        //category_id
        //foreign key relationName_id
        return $this->belongsTo(Category::class);
        
    }
}
