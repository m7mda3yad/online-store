<?php
namespace App\Entities\Admin;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
class SubFilter extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [		'name',        'filter_id'	];

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::Class,'product_sup_filters');
    }

}
