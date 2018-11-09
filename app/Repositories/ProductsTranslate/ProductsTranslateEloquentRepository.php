<?php

namespace App\Repositories\ProductsTranslate;

use App\Models\ProductsTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class ProductsTranslateEloquentRepository extends BaseEloquentRepository implements ProductsTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ProductsTranslation::class;
    }

    /**
     * Find by id related slug
     * @param $id
     * @return mixed
     */
    public function findByIdRelatedSlug($id)
    {
        $locale = app()->getLocale();
        $result = $this->model->join('blogs_translate', 'blogs_translate.blogs_id', '=', 'blogs.id')
            ->where('blogs_translate.blogs_id', $id)
            ->where('blogs_translate.locale', $locale)
            ->first();
        return $result;
    }

    public function getProductNextDate($id, $date)
    {
        $result = $this->model->where('created_at', '>=', $date)
            ->where('id', '!=', $id)
            ->first();
        return $result;
    }

    public function getProductPreviousDate($id, $date)
    {
        $result = $this->model->where('created_at', '<=', $date)
            ->where('id', '!=', $id)
            ->first();
        return $result;
    }

//    public function getAllProductPaginate($limit)
//    {
//        $result = $this->model->paginate($limit);
//
//        return $result;
//    }
}
