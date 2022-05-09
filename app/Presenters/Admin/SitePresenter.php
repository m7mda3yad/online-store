<?php

namespace App\Presenters\Admin;

use App\Transformers\Admin\SiteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SitePresenter.
 *
 * @package namespace App\Presenters\Admin;
 */
class SitePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SiteTransformer();
    }
}
