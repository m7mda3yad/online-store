<?php

namespace App\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Entities\Admin\Filter;

/**
 * Class FilterTransformer.
 *
 * @package namespace App\Transformers\Admin;
 */
class FilterTransformer extends TransformerAbstract
{
    /**
     * Transform the Filter entity.
     *
     * @param \App\Entities\Admin\Filter $model
     *
     * @return array
     */
    public function transform(Filter $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
