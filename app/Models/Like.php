<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // use HasFactory;
    protected $guarded = array("id");
    public static $rules = array(
        'shop_id' => 'required',
        'user_id' => 'required'
    );
}
