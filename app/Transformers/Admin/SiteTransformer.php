<?php

namespace App\Transformers\Admin;

use League\Fractal\TransformerAbstract;
use App\Entities\Admin\Site;

/**
 * Class SiteTransformer.
 *
 * @package namespace App\Transformers\Admin;
 */
class SiteTransformer extends TransformerAbstract
{
    /**
     * Transform the Site entity.
     *
     * @param \App\Entities\Admin\Site $model
     *
     * @return array
     */
    public function transform(Site $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
