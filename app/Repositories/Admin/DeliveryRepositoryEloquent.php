<?php

namespace App\Repositories\Admin;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Admin\DeliveryRepository;
use App\Entities\Admin\Delivery;
use App\Validators\DeliveryValidator;

/**
 * Class DeliveryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Admin;
 */
class DeliveryRepositoryEloquent extends BaseRepository implements DeliveryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Delivery::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
