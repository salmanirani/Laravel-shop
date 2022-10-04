<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty','size_id');
    }
    public function user()
    {
        //هر اردر متعلق به یه کاربره
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function pay()
    {
        return $this->hasMany(Pay::class);
    }
}
