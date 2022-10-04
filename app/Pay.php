<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'payments';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
