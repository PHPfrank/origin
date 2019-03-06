<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UsersRepository;
use App\Models\Users;
use App\Repositories\Validators\UsersValidator;

/**
 * Class UsersRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class UsersRepositoryEloquent extends BaseRepository implements UsersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Users::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 拼接搜索条件
     * @param array $data
     * @return string
     */
    public function search(array $data)
    {
        $where = "1 = 1";

        if (!empty($data) && is_array($data))
        {
            if (isset($data["nickname"])) $where .= " and nickname like '%" . $data["nickname"] . "%'";

            if (isset($data["uid"])) $where .= " and uid=" . $data["uid"];

            if (!empty($data["created_at"])) {
                $service_time = explode('-', $data['created_at']);
                $where .= " and service_time >= '" . $service_time[0] . "'";
                $where .= " and service_time <= '" . $service_time[1] . "'";
            }
        }
        return $where;
    }
    
}
