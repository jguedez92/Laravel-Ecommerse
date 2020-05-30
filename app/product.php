<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded =[];
    public function categories()
    {
        return $this->belongsToMany('\App\Category');
    }
    public function orders()
    {
       return $this->belongsToMany('\App\Order');
    }
}
