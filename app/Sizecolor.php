<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sizecolor extends Model
{
    protected $table = 'sizecolors';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
