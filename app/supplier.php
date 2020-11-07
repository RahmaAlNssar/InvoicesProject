<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table="suppliers";
    protected $fillable=['name','address','phone_number'];
    public $timestamps=false;

   public function products(){
       return hasMany('App\products','supplier_id');
   }
}
