<?php

namespace App\Presenters\Admin;

use App\Transformers\Admin\CountryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CountryPresenter.
 *
 * @package namespace App\Presenters\Admin;
 */
class CountryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CountryTransformer();
    }
}
