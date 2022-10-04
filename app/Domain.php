<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
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
