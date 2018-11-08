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
    protected $blogsRepository;

    /**
     * @var ProductsTranslateRepositoryInterface
     */
    protected $blogsTransRepository;


    /**
     * ProductService constructor.
     * @param ProductsRepositoryInterface $blogsRepository
     * @param ProductsTranslateRepositoryInterface $blogsTransRepository
     */
    public function __construct(
        ProductsRepositoryInterface $blogsRepository,
        ProductsTranslateRepositoryInterface $blogsTransRepository
    ) {
        $this->blogsRepository = $blogsRepository;
        $this->blogsTransRepository = $blogsTransRepository;
    }

    /**
     * Find blog
     *
     * @param $id
     * @return mixed
     */
    public function findProduct($id)
    {
        $data = $this->blogsRepository->find($id);
        return $data;
    }

    /**
     * Get all blog and paginate
     *
     * @return mixed
     */
    public function getAllProduct($limit)
    {
        $data = $this->blogsRepository->getAllPaginateWithTrash($limit);
        return $data;
    }

    /**
     * Get all blog and paginate to show in web
     *
     * @return mixed
     */
    public function getAllProductInWeb($limit)
    {
        $data = $this->blogsRepository->getAllPaginate($limit);
        return $data;
    }

    /**
     * Find blog by id
     *
     * @param $id
     * @return mixed
     */
    public function findProductBySlugId($id)
    {
        $data = $this->blogsRepository->findByIdRelatedSlug($id);
        return $data;
    }

    /**
     * @param $blog
     * @return mixed
     */
    public function findProductNext($blog)
    {
        $data = $this->blogsRepository->getProductNextDate($blog->id, $blog->created_at);
        return $data;
    }

    /**
     * @param $blog
     * @return mixed
     */
    public function findProductPrevious($blog)
    {
        $data = $this->blogsRepository->getProductPreviousDate($blog->id, $blog->created_at);
        return $data;
    }

    /**
     * Create new blog
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

            // Save data of base blog
            $data['author'] = Sentinel::getUser()->username;
            $dataMainProduct = formatDataBaseOnTable('blogs', $data);
            $result = $this->blogsRepository->create($dataMainProduct);

            // Update image to base blog
            if ($result) {
                $newName = uploadImage($result->id, $file, 'blog');
                $this->blogsRepository->update(
                    $result->id,
                    [
                        'image' => config('upload.blog') . $result->id . '/' . $newName
                    ]);
            }

            // Save translate data
            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $dataProductTrans = $value;
                $dataProductTrans['locale'] = $key;
                $dataProductTrans['blogs_id'] = $result->id;
                $this->blogsTransRepository->create($dataProductTrans);
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
     * Update blog
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
                $newName = uploadImage($id, $data['image'], 'blog');
                $data['image'] = config('upload.blog') . $id . '/' . $newName;
            }

            $dataBaseProduct = formatDataBaseOnTable('blogs', $data);
            $this->blogsRepository->update($id, $dataBaseProduct);

            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $this->blogsTransRepository->updateTrans('blogs_id', $id, $key, $value);
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
        $result = $this->blogsRepository->getSomeRandomData($number);
        return $result;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getProductLimit($limit)
    {
        $data = $this->blogsRepository->getDataLimit($limit)->get();
        return $data;
    }


    /**
     * Count blog
     * @return mixed
     */
    public function countProduct()
    {
        $data = $this->blogsRepository->countAll();
        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteProduct($id)
    {
        $delete = $this->blogsRepository->delete($id);
        return $delete;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restoreProduct($id)
    {
        $delete = $this->blogsRepository->restore($id);
        return $delete;
    }
    /**
     * Get all tags of blog
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
     * Save view blog
     * @param $blog
     * @param $view
     * @return mixed
     */
    public function saveViewProduct($blog, $view)
    {
        try {
            DB::beginTransaction();
            $data = $this->blogsRepository->update($blog->blogs_id, ['view' => $view]);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return $blog;
        }
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getProductViewJson($limit)
    {
        $data = $this->blogsRepository->getDataLimit($limit)->get();
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