<?php

namespace App\Services;

use App\Repositories\MenuProduct\MenuProductRepositoryInterface;
use App\Repositories\MenuProductTranslate\MenuProductTranslateRepositoryInterface;
use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\ProductsTranslate\ProductsTranslateRepositoryInterface;

use Exception;

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
     * @var MenuProductRepositoryInterface
     */
    protected $menuProductRepository;

    /**
     * @var MenuProductTranslateRepositoryInterface
     */
    protected $menuProductTransRepository;

    /**
     * ProductsService constructor.
     * @param ProductsRepositoryInterface $productsRepository
     * @param ProductsTranslateRepositoryInterface $productsTransRepository
     * @param MenuProductRepositoryInterface $menuProductRepository
     * @param MenuProductTranslateRepositoryInterface $menuProductTranslateRepository
     */
    public function __construct(
        ProductsRepositoryInterface $productsRepository,
        ProductsTranslateRepositoryInterface $productsTransRepository,
        MenuProductRepositoryInterface $menuProductRepository,
        MenuProductTranslateRepositoryInterface $menuProductTranslateRepository
    ) {
        $this->productsRepository = $productsRepository;
        $this->productsTransRepository = $productsTransRepository;
        $this->menuProductRepository = $menuProductRepository;
        $this->menuProductTranslateRepository = $menuProductTranslateRepository;
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