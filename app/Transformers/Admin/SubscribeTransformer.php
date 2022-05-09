<?php

namespace App\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Entities\Admin\Subscribe;

/**
 * Class SubscribeTransformer.
 *
 * @package namespace App\Transformers\Admin;
 */
class SubscribeTransformer extends TransformerAbstract
{
    /**
     * Transform the Subscribe entity.
     *
     * @param \App\Entities\Admin\Subscribe $model
     *
     * @return array
     */
    public function transform(Subscribe $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
