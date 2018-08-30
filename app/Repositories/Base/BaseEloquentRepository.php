<?php

namespace App\Repositories\Base;

abstract class BaseEloquentRepository implements BaseRepositoryInterface
{
    /**
     * ***********************************
     * ************ SET MODEL ************
     * ***********************************
     */

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

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
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get all with paginate
     *
     * @param $limit
     * @param string $orderBy
     * @return mixed
     */
    public function getAllPaginate($limit, $orderBy = 'created_at')
    {
        return $this->model->orderBy($orderBy)->paginate($limit);
    }

    /**
     * Get all paginate with trash
     *
     * @param $limit
     * @param string $orderBy
     * @return mixed
     */
    public function getAllPaginateWithTrash($limit, $orderBy = 'created_at')
    {
        $result = $this->model->withTrashed()->orderBy($orderBy)->paginate($limit);
        return $result;
    }

    /**
     * Get first data base on order
     *
     * @param $orderBy
     * @return mixed
     */
    public function getDataOrderBy($orderBy = 'created_at')
    {
        return $this->model->orderBy($orderBy);
    }

    /**
     * Get random data
     *
     * @param $number
     * @return mixed
     */
    public function getSomeRandomData($number)
    {
        return $this->model->inRandomOrder()->limit($number);
    }

    /**
     * Get data with offset and limit
     *
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function getDataLimit($limit, $offset = null)
    {
        if ($offset) {
            return $this->model->offset($offset)->limit($limit);
        } else {
            return $this->model->limit($limit);
        }
    }

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
    public function find($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    /**
     * Get one with trash
     *
     * @param $id
     * @return mixed
     */
    public function findWithTrash($id)
    {
        $result = $this->model->withTrashed()->find($id);
        return $result;
    }

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
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Multi create
     *
     * @param array $data
     * @return mixed
     */
    public function multiCreate($data)
    {
        if (!empty($data)) {
            foreach($data as $attributes) {
                $this->model->create($attributes);
            }
            return true;
        }
        return false;
    }

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
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Update translate
     *
     * @param $idColumn
     * @param $id
     * @param $locale
     * @param $data
     * @return mixed
     */
    public function updateTrans($idColumn, $id, $locale, $data)
    {
        $result = $this->model->where($idColumn, $id)->where('locale', $locale)->update($data);
        return $result;
    }

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
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }

    /**
     * Delete soft by destroy
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->forceDelete();
            return true;
        }
        return false;
    }

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
    public function restore($id)
    {
        $result = $this->model->where('id', $id)->withTrashed()->first();
        if ($result) {
            $result->restore();
            return true;
        }
        return false;
    }

    /**
     * Count all
     *
     * @return int|mixed
     */
    public function countAll()
    {
        $result = $this->model->all()->count();
        return $result;
    }
}
