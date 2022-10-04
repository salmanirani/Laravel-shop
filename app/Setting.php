<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
