<?php

namespace App\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Entities\Admin\SubFilter;

/**
 * Class SubFilterTransformer.
 *
 * @package namespace App\Transformers\Admin;
 */
class SubFilterTransformer extends TransformerAbstract
{
    /**
     * Transform the SubFilter entity.
     *
     * @param \App\Entities\Admin\SubFilter $model
     *
     * @return array
     */
    public function transform(SubFilter $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
