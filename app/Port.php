<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    protected $table = 'ports';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
