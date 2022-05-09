<?php

namespace App\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Entities\Admin\Delivery;

/**
 * Class DeliveryTransformer.
 *
 * @package namespace App\Transformers\Admin;
 */
class DeliveryTransformer extends TransformerAbstract
{
    /**
     * Transform the Delivery entity.
     *
     * @param \App\Entities\Admin\Delivery $model
     *
     * @return array
     */
    public function transform(Delivery $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
