<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
class Category extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name','active'];


    public function sub_categories()
    {
        return $this->hasMany(SubCategory::Class, 'category_id');
    }

}
