<?php

namespace App\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Entities\Admin\SubCategory;

/**
 * Class SubCategoryTransformer.
 *
 * @package namespace App\Transformers\Admin;
 */
class SubCategoryTransformer extends TransformerAbstract
{
    /**
     * Transform the SubCategory entity.
     *
     * @param \App\Entities\Admin\SubCategory $model
     *
     * @return array
     */
    public function transform(SubCategory $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
