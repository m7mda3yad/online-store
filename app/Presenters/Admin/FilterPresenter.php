<?php

namespace App\Presenters\Admin;

use App\Transformers\Admin\FilterTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FilterPresenter.
 *
 * @package namespace App\Presenters\Admin;
 */
class FilterPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FilterTransformer();
    }
}
