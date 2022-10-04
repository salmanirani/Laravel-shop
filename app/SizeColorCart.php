<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizeColorCart extends Model
{
    protected $table = 'sizecolorcart';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
