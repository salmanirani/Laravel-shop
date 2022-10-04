<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function delivary()
    {
        return $this->belongsTo(Delivery::class);
    }
}
