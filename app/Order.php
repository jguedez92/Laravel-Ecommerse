<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany('\App\Product')->withPivot('units');
    }
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}

