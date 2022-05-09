<?php

namespace App\Presenters\Admin;

use App\Transformers\Admin\SubCategoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SubCategoryPresenter.
 *
 * @package namespace App\Presenters\Admin;
 */
class SubCategoryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SubCategoryTransformer();
    }
}
