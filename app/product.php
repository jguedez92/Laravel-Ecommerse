<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded =[];
    
    public function user()
    {
        return $this->belongsTo('\App\user');
    }
    public function category()
    {
        return $this->belongsTo('\App\Category');
    }
    public function orders()
    {
       return $this->hasMany('\App\Order');
    }
}
