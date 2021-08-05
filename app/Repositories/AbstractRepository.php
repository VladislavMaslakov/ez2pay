<?php
namespace App\Repositories;


use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


abstract class AbstractRepository
{
    /**
     * @var Model
     */
    protected $model;

    protected $auth;

    abstract public function getModelClass(): string;

    public function setModel($model_path)
    {
        $this->model = app($model_path);
    }

    public function __construct()
    {
        $this->setModel($this->getModelClass());
        try {
            $this->auth = app(Guard::class);
        } catch (Exception $e) {

        }
    }

    public function getQuery()
    {
        return $this->model->query();
    }

    public function getOneById($id): ?Model
    {
        return $this->model->find($id);
    }

    public function getByIds(array $ids): Collection
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        $item->delete();
    }

    public function create(array $data)
    {
        $model = $this->model->create($data);
        return $model;
    }

    public function update(array $data, $id)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }
}
