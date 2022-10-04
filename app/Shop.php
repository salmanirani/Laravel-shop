<?php

namespace App;

use App\Wishlists;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ports()
    {
        return $this->hasMany(Port::class);

    }
    public function wishlist()
    {
        return $this->hasMany(Wishlists::class);

    }
    public function postal()
    {
        return $this->hasMany(Postal::class);

    }
    public function photo()
    {
        return $this->belongsTo(Photo::class);

    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }
     public function domains()
    {
        return $this->hasMany(Domain::class);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function slider()
    {
        return $this->hasMany(Slider::class);

    }
}
