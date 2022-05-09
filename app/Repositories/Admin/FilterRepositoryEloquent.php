<?php

namespace App\Repositories\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Admin\FilterRepository;
use App\Entities\Admin\Filter;
use App\Validators\FilterValidator;

/**
 * Class FilterRepositoryEloquent.
 *
 * @package namespace App\Repositories\Admin;
 */
class FilterRepositoryEloquent extends BaseRepository implements FilterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Filter::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
