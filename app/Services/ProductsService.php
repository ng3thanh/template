<?php

namespace App\Services;

use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\ProductsTranslate\ProductsTranslateRepositoryInterface;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductsService
{
    /**
     * @var ProductsRepositoryInterface
     */
    protected $productsRepository;

    /**
     * @var ProductsTranslateRepositoryInterface
     */
    protected $productsTransRepository;


    /**
     * ProductService constructor.
     * @param ProductsRepositoryInterface $productsRepository
     * @param ProductsTranslateRepositoryInterface $productsTransRepository
     */
    public function __construct(
        ProductsRepositoryInterface $productsRepository,
        ProductsTranslateRepositoryInterface $productsTransRepository
    ) {
        $this->productsRepository = $productsRepository;
        $this->productsTransRepository = $productsTransRepository;
    }

    /**
     * @return mixed
     */
    public function getAdminProductIndex($data)
    {
        if ($data['publish'] != null) {
             $arrayDate = breakStringToArray($data['publish'], ' - ');
             $data['publish_date']  = dateFormat($arrayDate[0], 'Y-m-d');
             $data['end_date']      = dateFormat($arrayDate[1], 'Y-m-d');
        } else {
            $data['publish_date']  = null;
            $data['end_date']      = null;
        }
        $data = $this->productsRepository->getAllProductWithTrash($data, null, 'publish_date');
        return $data;
    }
}