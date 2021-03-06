<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = array("id");
    public static $rules = array(
        'shop_id' => 'required',
        'user_id' => 'required'
    );
    //ใในใ
    public function shop()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_id');
    }
}
