<?php

namespace App;

use App\Wishlists;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function mtcategories()
    {
        return $this->belongsToMany(Mtcategory::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlists::class);

    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function instagram()
    {
        return $this->belongsTo(Instagram::class);
    }

    public function attributevalues()
    {
        return $this->belongsToMany(AttributeValue::class,'attributevalue_products','product_id','attributevalue_id');
    }
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
    public function shop()
    {
        return $this->belongsToMany(Shop::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('qty');
    }
    public function mtcomments()
    {
        return $this->hasMany(Mtcomment::class);
    }
    public function garanty()
    {
        return $this->belongsToMany(Garanty::class);
    }
    public function sizecolors()
    {
        return $this->hasMany(Sizecolor::class);
    }
    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);

    }
    public function sizecolorcart()
    {
        return $this->hasMany(SizeColorCart::class);

    }
    public function carts()
    {
        return $this->hasMany(Cart::class);

    }
}
