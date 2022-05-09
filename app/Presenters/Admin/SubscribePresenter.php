<?php

namespace App\Presenters\Admin;

use App\Transformers\Admin\SubscribeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UbscribePresenter.
 *
 * @package namespace App\Presenters\Admin;
 */
class SubscribePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UbscribeTransformer();
    }
}
