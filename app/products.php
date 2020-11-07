<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable=['id','product_name','price','category_id','supplier_id','description','section_id'];


    public function sections(){
        return $this->belongsTo('App\sections','section_id');
    }

    public function supplier(){
        return $this->belongsTo('App\supplier','supplier_id');
    }

    public function categories(){
        return $this->belongsTo('App\categories','category_id');
    }
}
