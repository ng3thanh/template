<?php

namespace App\Repositories\Base;

interface BaseRepositoryInterface
{
    /**
     * ***********************************
     * ********** GET ALL DATA ***********
     * ***********************************
     */

    /**
     * Get all
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get all with paginate
     *
     * @param $limit
     * @param string $orderBy
     * @return mixed
     */
    public function getAllPaginate($limit, $orderBy = 'created_at');

    /**
     * Get all paginate with trash
     *
     * @param $limit
     * @param string $orderBy
     * @return mixed
     */
    public function getAllPaginateWithTrash($limit, $orderBy = 'created_at');

    /**
     * Get first data base on order
     *
     * @param $orderBy
     * @return mixed
     */
    public function getDataOrderBy($orderBy = 'created_at');

    /**
     * Get random data
     *
     * @param $number
     * @return mixed
     */
    public function getSomeRandomData($number);

    /**
     * Get data with offset and limit
     *
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function getDataLimit($limit, $offset = null);

    /**
     * ***********************************
     * ********** GET ONE DATA ***********
     * ***********************************
     */

    /**
     * Get one
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Get one with trash
     *
     * @param $id
     * @return mixed
     */
    public function findWithTrash($id);

    /**
     * ***********************************
     * ********** CREATE DATA ************
     * ***********************************
     */

    /**
     * Create one
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Multi create
     *
     * @param array $data
     * @return mixed
     */
    public function multiCreate($data);

    /**
     * ***********************************
     * ********** UPDATE DATA ************
     * ***********************************
     */

    /**
     * Update one
     *
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes);

    /**
     * Update translate
     *
     * @param $idColumn
     * @param $id
     * @param $locale
     * @param $data
     * @return mixed
     */
    public function updateTrans($idColumn, $id, $locale, $data);

    /**
     * ***********************************
     * ********** DELETE DATA ************
     * ***********************************
     */

    /**
     * Delete soft by soft delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id);

    /**
     * Delete soft by destroy
     *
     * @param $id
     * @return bool
     */
    public function destroy($id);

    /**
     * ***********************************
     * ********** RESTORE DATA ***********
     * ***********************************
     */

    /**
     * Restore
     *
     * @param $id
     * @return mixed
     */
    public function restore($id);

    /**
     * Count all
     *
     * @return int|mixed
     */
    public function countAll();
}