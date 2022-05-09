<?php

namespace App\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Entities\Admin\City;

/**
 * Class CityTransformer.
 *
 * @package namespace App\Transformers\Admin;
 */
class CityTransformer extends TransformerAbstract
{
    /**
     * Transform the City entity.
     *
     * @param \App\Entities\Admin\City $model
     *
     * @return array
     */
    public function transform(City $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
