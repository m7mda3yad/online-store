<?php

namespace App\Repositories\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Admin\SubCategoryRepository;
use App\Entities\Admin\SubCategory;
use App\Validators\SubCategoryValidator;

/**
 * Class SubCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Admin;
 */
class SubCategoryRepositoryEloquent extends BaseRepository implements SubCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
