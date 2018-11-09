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
     * Find product
     *
     * @param $id
     * @return mixed
     */
    public function findProduct($id)
    {
        $data = $this->productsRepository->find($id);
        return $data;
    }

    /**
     * Get all product and paginate
     *
     * @return mixed
     */
    public function getAllProduct($limit)
    {
        $data = $this->productsRepository->getAllPaginateWithTrash($limit);
        return $data;
    }

    /**
     * Get all product and paginate to show in web
     *
     * @return mixed
     */
    public function getAllProductInWeb($limit)
    {
        $data = $this->productsRepository->getAllPaginate($limit);
        return $data;
    }

    /**
     * Find product by id
     *
     * @param $id
     * @return mixed
     */
    public function findProductBySlugId($id)
    {
        $data = $this->productsRepository->findByIdRelatedSlug($id);
        return $data;
    }

    /**
     * @param $product
     * @return mixed
     */
    public function findProductNext($product)
    {
        $data = $this->productsRepository->getProductNextDate($product->id, $product->created_at);
        return $data;
    }

    /**
     * @param $product
     * @return mixed
     */
    public function findProductPrevious($product)
    {
        $data = $this->productsRepository->getProductPreviousDate($product->id, $product->created_at);
        return $data;
    }

    /**
     * Create new product
     *
     * @param $data
     * @return bool
     */
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
            $data['author'] = Sentinel::getUser()->username;
            $dataMainProduct = formatDataBaseOnTable('products', $data);
            $result = $this->productsRepository->create($dataMainProduct);

            // Update image to base product
            if ($result) {
                $newName = uploadImage($result->id, $file, 'product');
                $this->productsRepository->update(
                    $result->id,
                    [
                        'image' => config('upload.product') . $result->id . '/' . $newName
                    ]);
            }

            // Save translate data
            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $dataProductTrans = $value;
                $dataProductTrans['locale'] = $key;
                $dataProductTrans['products_id'] = $result->id;
                $this->productsTransRepository->create($dataProductTrans);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * Update product
     *
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateProduct($id, $data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['image'])) {
                $newName = uploadImage($id, $data['image'], 'product');
                $data['image'] = config('upload.product') . $id . '/' . $newName;
            }

            $dataBaseProduct = formatDataBaseOnTable('products', $data);
            $this->productsRepository->update($id, $dataBaseProduct);

            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $this->productsTransRepository->updateTrans('products_id', $id, $key, $value);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $number
     * @return mixed
     */
    public function randomProduct($number)
    {
        $result = $this->productsRepository->getSomeRandomData($number);
        return $result;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getProductLimit($limit)
    {
        $data = $this->productsRepository->getDataLimit($limit)->get();
        return $data;
    }


    /**
     * Count product
     * @return mixed
     */
    public function countProduct()
    {
        $data = $this->productsRepository->countAll();
        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteProduct($id)
    {
        $delete = $this->productsRepository->delete($id);
        return $delete;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restoreProduct($id)
    {
        $delete = $this->productsRepository->restore($id);
        return $delete;
    }
    /**
     * Get all tags of product
     *
     * @param $id
     * @return mixed
     */
    public function getAllTagsOfProduct($id)
    {
        $tags = $this->tagsRepository->getAllTagsOfProduct($id);
        return $tags;
    }

    /**
     * Save view product
     * @param $product
     * @param $view
     * @return mixed
     */
    public function saveViewProduct($product, $view)
    {
        try {
            DB::beginTransaction();
            $data = $this->productsRepository->update($product->products_id, ['view' => $view]);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return $product;
        }
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getProductViewJson($limit)
    {
        $data = $this->productsRepository->getDataLimit($limit)->get();
        $result = [];
        foreach ($data as $key => $value)
        {
            $result[$key]['title'] = cutStringWithLongText($value->title, 50);
//            $result[$key]['title'] = $value->id;
            $result[$key]['view'] = $value->view;
        }
        return json_encode($result);
    }
}