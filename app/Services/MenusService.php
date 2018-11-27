<?php

namespace App\Services;

use App\Repositories\MenuNew\MenuNewRepositoryInterface;
use App\Repositories\MenuNewTranslate\MenuNewTranslateRepositoryInterface;
use App\Repositories\MenuProduct\MenuProductRepositoryInterface;
use App\Repositories\MenuProductTranslate\MenuProductTranslateRepositoryInterface;
use Exception;

class MenusService
{
    /**
     * @var MenuNewRepositoryInterface
     */
    protected $menuNewRepository;

    /**
     * @var MenuNewTranslateRepositoryInterface
     */
    protected $menuNewTransRepository;

    /**
     * @var MenuProductRepositoryInterface
     */
    protected $menuProductRepository;

    /**
     * @var MenuProductTranslateRepositoryInterface
     */
    protected $menuProductTransRepository;

    /**
     * MenusService constructor.
     * @param MenuNewRepositoryInterface $menuNewRepository
     * @param MenuNewTranslateRepositoryInterface $menuNewTransRepository
     * @param MenuProductRepositoryInterface $menuProductRepository
     * @param MenuProductTranslateRepositoryInterface $menuProductTranslateRepository
     */
    public function __construct(
        MenuNewRepositoryInterface $menuNewRepository,
        MenuNewTranslateRepositoryInterface $menuNewTransRepository,
        MenuProductRepositoryInterface $menuProductRepository,
        MenuProductTranslateRepositoryInterface $menuProductTranslateRepository
    ) {
        $this->menuNewRepository = $menuNewRepository;
        $this->menuNewTransRepository = $menuNewTransRepository;
        $this->menuProductRepository = $menuProductRepository;
        $this->menuProductTranslateRepository = $menuProductTranslateRepository;
    }

    public function getMenuForSelectBox()
    {
        $results = $this->menuProductRepository->getActiveMenuProduct()->toArray();
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