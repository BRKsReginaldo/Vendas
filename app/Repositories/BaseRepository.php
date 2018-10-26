<?php

namespace App\Repositories;


use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    /**
     * @return Builder
     */
    public function newQuery()
    {
        return resolve($this->model)->newQuery();
    }

    public function getSortFields()
    {
        return [];
    }

    /**
     * @param null $query
     * @param int $take
     * @param bool $paginate
     * @param bool $withTrashed
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function doQuery($query = null, $take = 20, $paginate = true, $withTrashed = false)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        if ($withTrashed) {
            $query->withTrashed();
        }

        if ($paginate) {
            return $query->paginate($take);
        }

        if ($take > 0 || $take !== false) {
            $query->take($take);
        }

        return $query->get();
    }

    /**
     * @param int $take
     * @param bool $paginate
     * @param null $query
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($take = 20, $paginate = true, $query = null)
    {
        return $this->doQuery($query, $take, $paginate);
    }

    /**
     * @param int $take
     * @param bool $paginate
     * @param null $query
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllTrashed($take = 20, $paginate = true, $query = null)
    {
        return $this->doQuery($query, $take, $paginate, true);
    }

    /**
     * @param $column
     * @param null $key
     * @return array
     */
    public function lists($column, $key = null)
    {
        return $this->newQuery()->lists($column, $key);
    }

    /**
     * @param $id
     * @param bool $fail
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function findById($id, $fail = true)
    {
        if ($fail) {
            return $this->newQuery()->findOrFail($id);
        }
        return $this->newQuery()->find($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return Model
     */
    public function updateById($id, array $data)
    {
        $model = $this->findById($id);

        return $this->updateByModel($model, $data);
    }

    /**
     * @param $model
     * @param array $data
     * @return Model
     */
    public function updateByModel(Model $model, array $data)
    {
        $model->update($data);

        return $model->fresh();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteById($id)
    {
        $model = $this->findById($id);

        return $this->deleteByModel($model);
    }

    /**
     * @param $model
     * @return bool
     * @throws \Exception
     */
    public function deleteByModel(Model $model)
    {
        return $model->delete();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $query = $this->newQuery();

        return $query->create($data);
    }

    public function restoreById($id)
    {
        $model = $this->newQuery()
            ->withTrashed()
            ->find($id);

        $model->restore();

        return $model->fresh();
    }
}