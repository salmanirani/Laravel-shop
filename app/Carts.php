<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table = 'carts';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
