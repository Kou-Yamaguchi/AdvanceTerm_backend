<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    // use HasFactory;
    protected $guarded = array("id");
    public static $rules = array(
        'genre_id' => 'required',
        'location_id' => 'required',
        'shopName' => 'required',
        'comment' => 'required',
        'img_url' => 'required'
    );
    public function genre()
    {
        return $this->belongsTo('App\Models\Genre', 'genre_id');
    }
    public function location()
    {
        return $this->belongsTo('App\Models\location', 'location_id');
    }
    public function like()
    {
        return $this->hasMany('App\Models\like', 'shop_id');
    }
}
