<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attributesvalue';
    public function attributegroup()
    {
        return $this->belongsTo(AttributeGroup::class,'attributegroub_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'attributevalue_products','attributevalue_id','product_id');
    }
}
