<?php

namespace App\Repository\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection as CollectionSupport;
use InvalidArgumentException;

interface RepositoryInterface
{
    /**
     * Begin querying the model.
     *
     * @return Builder
     */
    public function query();

    /**
     * Add a basic where clause to the query.
     *
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return Builder
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and');

    /**
     * Get all of the models from the database.
     *
     * @param array|mixed $columns
     * @return Collection|static[]
     */
    public function all($columns = ['*']);

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
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null);

    /**
     * Save a new model and return the instance.
     *
     * @param array $attributes
     * @return Model|Builder
     */
    public function create(array $attributes);

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
    public function update($id, array $data, array $options = []);

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param array $attributes
     * @param array $values
     * @return Model|static
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * Destroy the models for the given IDs.
     *
     * @param CollectionSupport|mixed|array|int $ids
     * @return int
     */
    public function destroy($ids);

    /**
     * Find a model by its primary key or return fresh model instance.
     *
     * @param mixed $id
     * @param array $columns
     * @return Model|static
     */
    public function findOrNew($id, $columns = ['*']);

    /**
     * Find a model by its primary key.
     *
     * @param mixed $id
     * @param array $columns
     * @return Model|Collection|static[]|static|null
     */
    public function find($id, array $columns = ['*']);

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param mixed $id
     * @param array $columns
     * @return Model|Collection|static|static[]
     *
     * @throws ModelNotFoundException
     */
    public function findOrFail($id, array $columns = ['*']);

    /**
     * Find multiple models by their primary keys.
     *
     * @param Arrayable|array $ids
     * @param array $columns
     * @return Collection
     */
    public function findMany($ids, array $columns = ['*']);

    /**
     * Find a model by a given key.
     *
     * @param string $attribute
     * @param $value
     * @param array $columns
     * @return Builder|Model|object|null
     */
    public function findBy(string $attribute, $value, array $columns = ['*']);

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
    public function findByOrFail(string $attribute, $value, array $columns = ['*']);

    /**
     * @param int $company_id
     * @return Builder
     */
    public function ofCompany(int $company_id);

    /**
     * @param int $company_id
     * @param int $id
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findOrFailFromCompany(int $company_id, int $id);
}
