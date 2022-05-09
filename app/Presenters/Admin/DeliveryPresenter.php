<?php

namespace App\Presenters\Admin;

use App\Transformers\Admin\DeliveryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DeliveryPresenter.
 *
 * @package namespace App\Presenters\Admin;
 */
class DeliveryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DeliveryTransformer();
    }
}
