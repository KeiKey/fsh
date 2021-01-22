<?php

namespace App\Repository\Classes;

use App\Repository\Contracts\RepositoryInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection as CollectionSupport;
use InvalidArgumentException;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var Model|Builder|SoftDeletes
     */
    protected $model;
    /**
     * @var Application
     */
    private $app;

    /**
     * @param Application $app
     * @throws Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return void
     * @throws Exception
     */
    private function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    /**
     * @return Model|Builder
     */
    abstract protected function model();

    /**
     * Begin querying the model.
     *
     * @return Builder
     */
    public function query()
    {
        return $this->model->query();
    }

    /**
     * Add a basic where clause to the query.
     *
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return Builder
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        return $this->model->where($column, $operator, $value, $boolean);
    }

    /**
     * Get all of the models from the database.
     *
     * @param array|mixed $columns
     * @return Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Paginate the given query.
     *
     * @param int|null $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @return LengthAwarePaginator
     *
     * @throws InvalidArgumentException
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param array $attributes
     * @return Model|Builder
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param mixed $id
     * @param array $data
     * @param array $options
     * @return bool|int
     *
     * @throws ModelNotFoundException
     */
    public function update($id, array $data, array $options = [])
    {
        return $this->model->findOrFail($id)->update($data, $options);
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param array $attributes
     * @param array $values
     * @return Model|static
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values = []);
    }

    /**
     * Destroy the models for the given IDs.
     *
     * @param CollectionSupport|mixed|array|int $ids
     * @return int
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * Find a model by its primary key or return fresh model instance.
     *
     * @param mixed $id
     * @param array $columns
     * @return Model|static
     */
    public function findOrNew($id, $columns = ['*'])
    {
        return $this->model->findOrNew($id, $columns = ['*']);
    }

    /**
     * Find a model by its primary key.
     *
     * @param mixed $id
     * @param array $columns
     * @return Model|Collection|static[]|static|null
     */
    public function find($id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param mixed $id
     * @param array $columns
     * @return Model|Collection|static|static[]
     *
     * @throws ModelNotFoundException
     */
    public function findOrFail($id, array $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Find multiple models by their primary keys.
     *
     * @param Arrayable|array $ids
     * @param array $columns
     * @return Collection
     */
    public function findMany($ids, array $columns = ['*'])
    {
        return $this->model->findMany($ids, $columns = ['*']);
    }

    /**
     * Find a model by a given key.
     *
     * @param string $attribute
     * @param $value
     * @param array $columns
     * @return Builder|Model|object|null
     */
    public function findBy(string $attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * Find a model by a given key or throw an exception.
     *
     * @param string $attribute
     * @param $value
     * @param array $columns
     * @return Builder|Model|object|null
     *
     * @throws ModelNotFoundException
     */
    public function findByOrFail(string $attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->firstOrFail($columns);
    }

    /**
     * @param int $company_id
     * @param int $id
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findOrFailFromCompany(int $company_id, int $id)
    {
        return $this->ofCompany($company_id)
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * @param int $company_id
     * @return Builder
     */
    public function ofCompany(int $company_id)
    {
        return $this->model->where('company_id', $company_id)->orderBy('created_at', 'asc');
    }
}
