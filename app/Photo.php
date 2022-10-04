<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploads = '/images/';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
    public function medals()
    {
        return $this->hasMany(Medal::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);

    }

    public function getPathAttribute($photo)
    {
        return $this->uploads . $photo;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function garanty()
    {
        return $this->belongsTo(Garanty::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}

