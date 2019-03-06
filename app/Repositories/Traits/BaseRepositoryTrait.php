<?php
namespace App\Repositories\Traits;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/3
 * Time: 10:43
 */
trait BaseRepositoryTrait
{
    /**
     * 根据条件获取一条数据
     * @param array $where
     * @param array $columns
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function  firstWhere(array $where, $columns = ['*']){

        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->first($columns);

        $this->resetModel();

        return $this->parserResult($model);

    }

    /**
     * 根据条件获取最新一条数据
     * @param array $where
     * @param array $columns
     * @param string $orderBy
     * @param string $desc
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function firstWhereNew(array $where,$columns  = ['*'],$orderBy="id",$desc="desc"){

        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->orderBy($orderBy,$desc)->first($columns);

        $this->resetModel();

        return $this->parserResult($model);
    }
    /**
     * 根据条件更新
     * @param array $where
     * @param array $data
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function updateWhere(array $where,array $data){

        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->update($data);

        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * 根据多条件更新
     * @param $field
     * @param array $values
     * @param array $data
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function updateWhereIn($field,array $values,array $data){

        $this->applyCriteria();
        $this->applyScope();

        $model = $this->model->whereIn($field,$values)->update($data);

        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * 根据where数组获取列表
     * @param $where
     * @param null $orderRaw
     * @param array $columns
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function getWhereList(array $where,$orderRaw=null,$columns=['*'],$page=1,$limit=10)
    {
        if ($orderRaw == null){

            $orderRaw = "id desc";
        }

        $result['list'] = $this->model
            ->where($where)
            ->orderByRaw($orderRaw)
            ->select($columns)
            ->forPage($page, $limit)
            ->get();

        $result['count'] = $this->model
            ->where($where)
            ->count();

        return $result;
    }

    /**
     * 根据whereRaw条件获取列表
     * @param $where
     * @param null $orderRaw
     * @param array $columns
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function getWhereListByLaw($where,$orderRaw=null,$columns=['*'],$page=1,$limit=10){

        if ($orderRaw == null){

            $orderRaw = "id desc";
        }

        $result['list'] = $this->model
            ->whereRaw($where)
            ->orderByRaw($orderRaw)
            ->select($columns)
            ->forPage($page, $limit)
            ->get();

        $result['count'] = $this->model
            ->whereRaw($where)
            ->count();

        return $result;
    }

    /**
     * 多选删除
     * @param array $data
     * @param string $id
     * @return mixed
     */
    public function delWhereIn(array  $data,$id=""){

        if (empty($id)){

            $id = "id";
        }

        $result = $this->model->whereIn($id, $data)->delete();

        return $result;
    }

    /**
     * whereIn查询
     * @param $field
     * @param array $value
     * @param array $columns
     * @return mixed
     */
    public function getByWhereIn($field, array $value, $columns = ['*'])
    {

        return $this->model->whereIn($field, $value)->get($columns);
    }
    /**
     * 根据key或者最大
     * @param string $data
     * @return mixed
     */
    public function getMax($data='id'){

        $result  = $this->model->max($data);

        return $result;
    }

    /**
     * 根据条件获取count总数
     * @param array $where
     * @return mixed
     */
    public function getCount(array $where){

        $result  = $this->model->where($where)->count();

        return $result;
    }

    /**
     * 根据条件获取不在count总数
     * @param array $where
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getCountNotIn(array $where,$field,array $values,$columns=['*']){

        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->where($where)->whereNotIn($field, $values)->count($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }
    /**
     * 计算总和
     * @param array $where
     * @param string $parameter
     * @return mixed
     */
    public function getSum(array $where,$parameter=""){

        return $this->model->where($where)->sum($parameter);
    }
    /**
     * 设置递增
     * @param array $where
     * @param array $data
     * @return bool
     */
    public function setIncrement(array $where,array $data){
        if (is_array($data)){
            foreach ($data as $key => $value){
                return $this->model->where($where)->increment($key,$value);
            }
        }
        return false;
    }

    /**
     * 设置递减
     * @param array $where
     * @param array $data
     * @return bool
     */
    public function setDecrement(array $where,array $data){
        if (is_array($data)){
            foreach ($data as $key => $value){
                return $this->model->where($where)->decrement($key,$value);
            }
        }
        return false;
    }

    public function wherePaginate(array $where,$columns = ['*'],$limit=null,$method = "paginate"){

        $this->applyCriteria();

        $this->applyScope();

        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;

        $results = $this->model->where($where)->{$method}($limit, $columns);

        $results->appends(app('request')->query());

        $this->resetModel();

        return $this->parserResult($results);
    }

    public function whereRawPaginate($where,$columns = ['*'],$limit=null,$method = "paginate"){

        $this->applyCriteria();

        $this->applyScope();

        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;

        $results = $this->model->whereRaw($where)->{$method}($limit, $columns);

        $results->appends(app('request')->query());

        $this->resetModel();

        return $this->parserResult($results);
    }

    /**
     * 批量更新
     * 批量之前需要确保in里面的key不重复，否则后面一个不更新
     * @param string $tableName
     * @param array $multipleData
     * @return bool|int
     */
    public function updateBatch($tableName = "",$multipleData = array()){

        if ($tableName && !empty($multipleData)){

            $updateColumn    = array_keys($multipleData[0]);

            $referenceColumn = $updateColumn[0];

            unset($updateColumn[0]);

            $whereIn = "";

            $query = "UPDATE ".$tableName." SET ";

            foreach ($updateColumn as $item){

                $query .=  $item." = CASE ";

                foreach ($multipleData as $data){

                    $query .= "WHEN ".$referenceColumn." = ".$data[$referenceColumn]." THEN '".$data[$item]."' ";
                }

                $query .= "ELSE ".$item." END, ";
            }

            foreach ($multipleData as $data){

                $whereIn .= "'".$data[$referenceColumn]."', ";

            }

            $query = rtrim($query,", ")." WHERE ".$referenceColumn." IN (".rtrim($whereIn,', ').")";

            return DB::update(DB::raw($query));

        }else{
            return false;
        }
    }
}