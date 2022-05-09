<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SubCategory extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable = ['name','category_id','active'];

    public function category()
    {
        return $this->belongsTo(Category::Class, 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::Class, 'sub_category_id');
    }
    public function filters()
    {
        return $this->belongsToMany(Filter::Class, 'filter_sub_categories');
    }

}
