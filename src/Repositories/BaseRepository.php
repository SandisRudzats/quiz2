<?php

namespace Quiz\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Quiz\Models\UserModel;

abstract class BaseRepository
{
    /**
     * @return string
     */
    protected abstract function getModelClass();

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function one(array $conditions = []): ?Model
    {
        /** @var  Model $className */
        $className = $this->getModelClass();
        $model = $className::query()->where($conditions)->first();

        return $model;
    }

    /**
     * @param array $conditions
     * @return Builder[]|Collection
     */
    public function all(array $conditions = [])
    {
        /** @var  Model $className */
        $className = $this->getModelClass();


        $models = $className::query()->where($conditions)->get();

        return $models;

    }
    public function create(array $data): Model
    {
        /** @var Model $className */
        $className = $this->getModelClass();
        /** @var Model $model */
        $model = new $className();
        $model->fill($data);
        $model->save();
        return $model;
    }
    /**
     * @param array $conditions
     * @return bool
     */
    public function exists(array $conditions = [])
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $rowExists = $className::query()->where($conditions)->exists();

        return $rowExists;
    }

    /**
     * @param array $conditions
     * @return int
     */
    public function count(array $conditions = [])
    {
        /** @var Model $className */
        $className = $this->getModelClass();

        $count = $className::query()->where($conditions)->count();

        return $count;
    }



}