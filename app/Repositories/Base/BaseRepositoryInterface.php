<?php

namespace App\Repositories\Base;

interface BaseRepositoryInterface
{
    /**
     * Get first data base on order
     * @param $orderBy
     * @return mixed
     */
    public function getDataOrderBy($orderBy);

    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get all with paginate
     * @return mixed
     */
    public function getAllPaginate($limit);

    /**
     * Get all paginate with trash
     * @param $limit
     * @return mixed
     */
    public function getAllPaginateWithTrash($limit);

    /**
     * Get random data
     * @param $number
     * @return mixed
     */
    public function getSomeRandomData($number);

    /**
     * Get data with offset and limit
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function getDataLimit($limit, $offset = null);

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Get one with trash
     * @param $id
     * @return mixed
     */
    public function findWithTrash($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Restore
     * @param $id
     * @return mixed
     */
    public function restore($id);

    /**
     * @return mixed
     */
    public function countAll();

    /**
     * @param $idColumn
     * @param $id
     * @param $locale
     * @param $data
     * @return mixed
     */
    public function updateTrans($idColumn, $id, $locale, $data);
}