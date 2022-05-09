<?php

namespace App\Entities\Admin;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Country extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable = [ 'name',	];


public function cities()
{
    return $this->hasMany(City::class);
}

}
