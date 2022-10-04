<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mtcategory extends Model
{
    public function children()
    {
        return $this->hasMany(Mtcategory::class,'parent_id');

    }

    public function childrenReqursive()
    {
        return $this->children()->with('childrenReqursive');

    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function attributeGroups()
    {
        return $this->belongsToMany(AttributeGroup::class,'attributegroup_category','mtcategory_id','attributegroup_id');
    }
}
