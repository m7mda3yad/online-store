<?php

namespace App\Repositories\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Admin\SubFilterRepository;
use App\Entities\Admin\SubFilter;
use App\Validators\SubFilterValidator;

/**
 * Class SubFilterRepositoryEloquent.
 *
 * @package namespace App\Repositories\Admin;
 */
class SubFilterRepositoryEloquent extends BaseRepository implements SubFilterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubFilter::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
