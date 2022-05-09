<?php

namespace App\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Entities\Admin\Country;

/**
 * Class CountryTransformer.
 *
 * @package namespace App\Transformers\Admin;
 */
class CountryTransformer extends TransformerAbstract
{
    /**
     * Transform the Country entity.
     *
     * @param \App\Entities\Admin\Country $model
     *
     * @return array
     */
    public function transform(Country $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
