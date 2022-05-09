<?php
namespace App\Entities\Admin;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
class City extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable = [		'name',		'country_id',	'price',];



    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
