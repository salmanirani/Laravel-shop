<?php

namespace App;

use App\Product;
use App\Shop;
use App\User;

use Illuminate\Database\Eloquent\Model;


class Wishlists extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
