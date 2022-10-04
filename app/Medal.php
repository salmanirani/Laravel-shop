<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medal extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

}
