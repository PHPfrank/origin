<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AdminLogRepository;
use App\Models\AdminLog;
use App\Repositories\Validators\AdminLogValidator;

/**
 * Class AdminLogRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class AdminLogRepositoryEloquent extends BaseRepository implements AdminLogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminLog::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
