<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    // protected $guarded = array('id');
    public function shop()
    {
        return $this->belongsTo('App\Models\shop', 'shop_id');
    }
}
