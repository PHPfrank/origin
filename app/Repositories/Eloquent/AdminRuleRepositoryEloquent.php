<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AdminRuleRepository;
use App\Models\AdminRule;
use App\Repositories\Validators\AdminRuleValidator;

/**
 * Class AdminRuleRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class AdminRuleRepositoryEloquent extends BaseRepository implements AdminRuleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminRule::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
