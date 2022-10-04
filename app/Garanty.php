<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garanty extends Model
{
    protected $table = 'garanties';
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
