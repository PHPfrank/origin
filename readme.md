## 设计模块
* presenter，显示需求
* repository，存取需求
* validator，参数验证需求
* services，业务逻辑

## repository注意事项
* 发布model : php artisan make:entity UserOrder
* 允许修改的model字段白名单 ：protected $fillable;
* 不允许修改的model字段 ：protected $guarded = [];

## repository常用方法
* all($columns = array('*'))
* first($columns = array('*'))
* paginate($limit = null, $columns = ['*'])
* find($id, $columns = ['*'])
* findByField($field, $value, $columns = ['*'])
* findWhere(array $where, $columns = ['*'])
* findWhereIn($field, array $where, $columns = [*])
* findWhereNotIn($field, array $where, $columns = [*])
* create(array $attributes)
* update(array $attributes, $id)
* updateOrCreate(array $attributes, array $values = [])
* delete($id)
* orderBy($column, $direction = 'asc');
* with(array $relations);
* has(string $relation);
* whereHas(string $relation, closure $closure);
* hidden(array $fields);
* visible(array $fields);
* scopeQuery(Closure $scope);
* getFieldsSearchable();
* setPresenter($presenter);
* skipPresenter($status = true);