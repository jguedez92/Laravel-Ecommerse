<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded =[];
    public function category()
    {
        return $this->belongsTo('\App\Category');
    }
    public function orders()
    {
       return $this->belongsToMany('\App\Order');
    }
}
