<?php

namespace App\Services;

use App\Repositories\ProductsMenu\ProductsMenuRepositoryInterface;
use App\Repositories\ProductsMenuTranslate\ProductsMenuTranslateRepositoryInterface;
use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\ProductsTranslate\ProductsTranslateRepositoryInterface;

use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
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
     * @var ProductsMenuRepositoryInterface
     */
    protected $menuProductRepository;

    /**
     * @var ProductsMenuTranslateRepositoryInterface
     */
    protected $menuProductTransRepository;

    /**
     * ProductsService constructor.
     * @param ProductsRepositoryInterface $productsRepository
     * @param ProductsTranslateRepositoryInterface $productsTransRepository
     * @param ProductsMenuRepositoryInterface $menuProductRepository
     * @param ProductsMenuTranslateRepositoryInterface $menuProductTranslateRepository
     */
    public function __construct(
        ProductsRepositoryInterface $productsRepository,
        ProductsTranslateRepositoryInterface $productsTransRepository,
        ProductsMenuRepositoryInterface $menuProductRepository,
        ProductsMenuTranslateRepositoryInterface $menuProductTranslateRepository
    ) {
        $this->productsRepository = $productsRepository;
        $this->productsTransRepository = $productsTransRepository;
        $this->menuProductRepository = $menuProductRepository;
        $this->menuProductTranslateRepository = $menuProductTranslateRepository;
    }

    /**
     * Get product to index page (admin)
     * @param $data
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
            $data['menu_id']       = null;
        }
        $data = $this->productsRepository->getAllProductWithTrash($data, null, 'publish_date');
        return $data;
    }

    /**
     * Get product data for copy and detail page
     *
     * @param $id
     * @return mixed
     */
    public function findProduct($id)
    {
        return $this->productsRepository->find($id);
    }

    public function createProduct($data)
    {
        try {
            DB::beginTransaction();

            // Get image
            if (isset($data['image'])) {
                $file = $data['image'];
                unset($data['image']);
            }

            // Save data of base product
            $data['author'] = auth()->user()->username;
            $dataMain = formatDataBaseOnTable('products', $data);

            $result = $this->productsRepository->create($dataMain);

            // Update image to base product
//            if ($result) {
//                $newName = uploadImage($result->id, $file, 'product');
//                $this->productsRepository->update(
//                    $result->id,
//                    [
//                        'image' => config('upload.product') . $result->id . '/' . $newName
//                    ]);
//            }

            // Save translate data
            $dataTranslates = $data['trans'];

            foreach ($dataTranslates as $key => $value) {
                $productTranslate = $value;
                $productTranslate['locale'] = $key;
                $productTranslate['products_id'] = $result->id;
                $this->productsTransRepository->create($productTranslate);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }
}