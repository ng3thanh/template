<?php

namespace App\Repositories\Products;

use App\Models\Products;
use App\Repositories\Base\BaseEloquentRepository;

class ProductsEloquentRepository extends BaseEloquentRepository implements ProductsRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Products::class;
    }

    /**
     * @param $data
     * @param null $limit
     * @param string $orderBy
     * @return mixed
     */
    public function getAllProductWithTrash($data, $limit = null, $orderBy = 'created_at')
    {
        $result = $this->model->leftJoin('products_image', 'products.id', '=', 'products_image.products_id')
            ->join('products_translate', 'products.id', '=', 'products_translate.products_id')
            ->select('products.*',
                'products_image.alt',
                'products_image.name AS image',
                'products_translate.name',
                'products_translate.locale',
                'products_translate.content',
                'products_translate.description');

        if (isset($data['locale'])) {
            $result = $result->where('locale', $data['locale']);
        } else {
            $result = $result->where('locale', 'vi');
        }

        if (isset($data['menu_id'])) {
            $result = $result->where('menu_id', $data['menu_id']);
        }

        if (isset($data['publish_date'])) {
            $result = $result->where('publish_date', '>=',$data['publish_date']);
        }

        if (isset($data['end_date'])) {
            $result = $result->where('end_date', '<=',$data['end_date']);
        }

        $result = $result->withTrashed()->orderBy($orderBy);

        if ($limit) {
            $result = $result->paginate($limit);
        } else {
            $result = $result->get();
        }

        return $result;
    }
}
