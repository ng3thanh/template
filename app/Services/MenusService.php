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

    public function getListActiveMenuProduct()
    {
        $results = $this->menuProductRepository->getActiveMenuProduct()->toArray();
        $menus = [];
        foreach($results as $key => $value) {
            switch ($value['level']) {
                case 1:
                    $menus[$value['id']] = $value;
                    break;
                case 2:
                    $menus[$value['parent_id']]['child'][$value['id']] = $value;
                    break;
                case 3:
                    $keyP = $menus[$value['parent_id']]['child']['parent_id'];
                    dd($keyP);
                    $menus[$keyP]['child'][$value['parent_id']]['child'][$value['id']] = $value;
                    break;
            }
        }
        return $menus;
    }
}