<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
