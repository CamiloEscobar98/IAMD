<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Exception;

class DuplicatedRecordException extends Exception
{

    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct('The record already exists in the database.', $code, $previous);
    }
}

class AbstractRepository
{

    public function with($relations)
    {
        if (is_string($relations)) $relations = func_get_args();

        $this->with = $relations;

        return $this;
    }

    protected function eagerLoadRelations()
    {
        if (!is_null($this->with)) {
            foreach ($this->with as $relation) {
                $this->model->with($relation);
            }
        }

        return $this;
    }

    /**
     * @var Model $model
     */
    protected $model;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    function all()
    {
        return $this->model->all();
    }


    /**
     * @return Model $model
     */
    public function randomFirst()
    {
        return $this->model->all()->random(1)->first();
    }
    /**
     * @return static
     */
    function newInstance()
    {
        return $this->model->newInstance();
    }

    /**
     * @param $id
     *
     * @return Model
     */
    function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param mixed $id
     * @param array $relations
     */
    public function getByIdWithRelations($id, $relations = [])
    {
        $query = $this->model->with($relations)->where('id', $id);

        return $query->get()->first();
    }


    /**
     * @param string $attribute
     * @param string $value
     * 
     * @return Model
     */
    public function getByAttribute(string $attribute, string $value)
    {
        return $this->model->all()->where($attribute, $value)->first();
    }

    /**
     * @param array $search
     * 
     * @return Model
     */
    public function getByAttributes(array $search)
    {
        $query = $this->model->select();

        foreach ($search as $item) {
            $operator = isset($item['operator']) && $item['operator'] ? $item['operator'] : '=';
            $query->where($item['option'], $operator, $item['value']);
        }

        return $query->get()->first();
    }

    function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    function first()
    {
        return $this->model->first();
    }


    /**
     * @param array $attributes
     *
     * @return static
     */
    function firstOrCreate(array $attributes = [])
    {
        return $this->model->firstOrCreate($attributes);
    }

    /**
     * @param array $search
     * @param array $attributes
     *
     * @return Model
     */
    function updateOrCreate(array $search = [], array $attributes = [])
    {
        return $this->model->updateOrCreate($search, $attributes);
    }

    /**
     * @param array $input
     *
     * @return static
     * @throws DuplicatedRouteException
     * @throws Exception
     * @throws \Exception
     */
    function create(array $input)
    {
        try {
            return $this->model->create($input);
        } catch (Exception $e) {
            if ($e->getCode() == '23000') {
                throw new DuplicatedRecordException;
            }
            throw $e;
        }
    }

    /**
     * @param array $input
     *
     * @return static
     */
    function forceCreate(array $input)
    {
        $this->model->unguard();
        $instance = $this->model->create($input);
        $this->model->reguard();

        return $instance;
    }

    /**
     * @throws \Exception
     */
    public function deleteAll()
    {
        $this->model->delete();
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function save(Model $model)
    {
        return $model->save();
    }

    /**
     * @param Model $model
     * @param array $attributes
     * @return bool
     */
    public function update(Model $model, array $attributes)
    {
        return $model->update($attributes);
    }

    /**
     * Delete an Eloquent Model from database
     *
     * @param Model $model
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }

    /**
     * @param Model $model
     *
     * @return void
     */
    public function forceDelete(Model $model)
    {
        return $model->forceDelete();
    }

    /**
     * Truncate model table
     */
    public function truncate()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->model->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1 ;');
    }

    /**
     * Get PerPage from Model
     * 
     * @return int
     */
    public function getPerPage()
    {
        return $this->model->getPerPage();
    }

    /** Factory Methods */

    /**
     * @param array $params
     *
     * @return Model
     */
    public function createOneFactory(array $params = [])
    {
        return $this->model->factory()->create($params);
    }

    /**
     * @param int $count
     * @param array $params
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createFactory(int $count = 5, array $params = [])
    {
        return $this->model->factory()->count($count)->create($params);
    }
}
