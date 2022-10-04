<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postal extends Model
{
    protected $table = 'postal';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
