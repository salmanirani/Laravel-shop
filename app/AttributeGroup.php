<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $table = 'attributesgroup';

    public function attributesvalue()
    {
        return $this->hasMany(AttributeValue::class,'attributegroub_id');
    }
    public function mtcategories()
    {
        return $this->belongsToMany(Mtcategory::class,'attributegroup_category','attributegroup_id','mtcategory_id');
    }
}

