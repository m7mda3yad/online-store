<?php

namespace App\Presenters\Admin;

use App\Transformers\Admin\SubFilterTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SubFilterPresenter.
 *
 * @package namespace App\Presenters\Admin;
 */
class SubFilterPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SubFilterTransformer();
    }
}
