<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Filter.
 *
 * @package namespace App\Entities\Admin;
 */
class Filter extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
		'name',
	];


    public function sub_filters()
    {
        return $this->hasMany(SubFilter::Class);
    }


}
