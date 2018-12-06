<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AdminGroupRepository;
use App\Models\AdminGroup;
use App\Repositories\Validators\AdminGroupValidator;

/**
 * Class AdminGroupRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class AdminGroupRepositoryEloquent extends BaseRepository implements AdminGroupRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminGroup::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
