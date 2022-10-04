<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}
