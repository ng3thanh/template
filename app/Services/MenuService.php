<?php

namespace App\Services;

use App\Repositories\NewsMenu\NewsMenuRepositoryInterface;
use App\Repositories\NewsMenuTranslate\NewsMenuTranslateRepositoryInterface;
use App\Repositories\ProductsMenu\ProductsMenuRepositoryInterface;
use App\Repositories\ProductsMenuTranslate\ProductsMenuTranslateRepositoryInterface;
use Exception;

class MenuService
{
    /**
     * @var NewsMenuRepositoryInterface
     */
    protected $newsMenuRepository;

    /**
     * @var NewsMenuTranslateRepositoryInterface
     */
    protected $newsMenuTransRepository;

    /**
     * @var ProductsMenuRepositoryInterface
     */
    protected $productsMenuRepository;

    /**
     * @var ProductsMenuTranslateRepositoryInterface
     */
    protected $productsMenuTransRepository;

    /**
     * MenusService constructor.
     * @param NewsMenuRepositoryInterface $newsMenuRepository
     * @param NewsMenuTranslateRepositoryInterface $newsMenuTransRepository
     * @param ProductsMenuRepositoryInterface $productsMenuRepository
     * @param ProductsMenuTranslateRepositoryInterface $productsMenuTranslateRepository
     */
    public function __construct(
        NewsMenuRepositoryInterface $newsMenuRepository,
        NewsMenuTranslateRepositoryInterface $newsMenuTransRepository,
        ProductsMenuRepositoryInterface $productsMenuRepository,
        ProductsMenuTranslateRepositoryInterface $productsMenuTranslateRepository
    ) {
        $this->newsMenuRepository = $newsMenuRepository;
        $this->newsMenuTransRepository = $newsMenuTransRepository;
        $this->productsMenuRepository = $productsMenuRepository;
        $this->productsMenuTranslateRepository = $productsMenuTranslateRepository;
    }

    public function getMenuForSelectBox()
    {
        $results = $this->productsMenuRepository->getActiveProductsMenu()->toArray();
        $menus = [];
        foreach($results as $key => $value) {
            if ($value['parent_id'] == 0) {
                $menus[$value['id']] = $value;
            } elseif (array_key_exists($value['parent_id'], $menus)) {
                $menus[$value['parent_id']]['child'][$value['id']] = $value;
            } else {
                $keyP = $results[$value['parent_id']]['parent_id'];
                if ($keyP != 0) {
                    $menus[$keyP]['child'][$value['parent_id']]['child'][$value['id']] = $value;
                }
            }
        }
        return $menus;
    }
}