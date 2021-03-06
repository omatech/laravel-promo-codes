<?php

namespace Omatech\LaravelPromoCodes\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * @return mixed
     */
    public abstract function model();

    /**
     * @return Model|mixed
     * @throws Exception
     */
    private function makeModel()
    {
        $model = app()->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        $model = $this->model->find($id);
        return $model ?? null;
    }
}