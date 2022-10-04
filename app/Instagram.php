<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instagram extends Model
{
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
