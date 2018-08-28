<?php

namespace App\Services;

use App\Repositories\Blogs\BlogsRepositoryInterface;
use App\Repositories\BlogsTranslate\BlogsTranslateRepositoryInterface;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;

class BlogService
{
    /**
     * @var BlogsRepositoryInterface
     */
    protected $blogsRepository;

    /**
     * @var BlogsTranslateRepositoryInterface
     */
    protected $blogsTransRepository;


    /**
     * BlogService constructor.
     * @param BlogsRepositoryInterface $blogsRepository
     * @param BlogsTranslateRepositoryInterface $blogsTransRepository
     */
    public function __construct(
        BlogsRepositoryInterface $blogsRepository,
        BlogsTranslateRepositoryInterface $blogsTransRepository
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
    public function findBlog($id)
    {
        $data = $this->blogsRepository->find($id);
        return $data;
    }

    /**
     * Get all blog and paginate
     *
     * @return mixed
     */
    public function getAllBlog($limit)
    {
        $data = $this->blogsRepository->getAllPaginateWithTrash($limit);
        return $data;
    }

    /**
     * Get all blog and paginate to show in web
     *
     * @return mixed
     */
    public function getAllBlogInWeb($limit)
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
    public function findBlogBySlugId($id)
    {
        $data = $this->blogsRepository->findByIdRelatedSlug($id);
        return $data;
    }

    /**
     * @param $blog
     * @return mixed
     */
    public function findBlogNext($blog)
    {
        $data = $this->blogsRepository->getBlogNextDate($blog->id, $blog->created_at);
        return $data;
    }

    /**
     * @param $blog
     * @return mixed
     */
    public function findBlogPrevious($blog)
    {
        $data = $this->blogsRepository->getBlogPreviousDate($blog->id, $blog->created_at);
        return $data;
    }

    /**
     * Create new blog
     *
     * @param $data
     * @return bool
     */
    public function createBlog($data)
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
            $dataMainBlog = formatDataBaseOnTable('blogs', $data);
            $result = $this->blogsRepository->create($dataMainBlog);

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
                $dataBlogTrans = $value;
                $dataBlogTrans['locale'] = $key;
                $dataBlogTrans['blogs_id'] = $result->id;
                $this->blogsTransRepository->create($dataBlogTrans);
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
    public function updateBlog($id, $data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['image'])) {
                $newName = uploadImage($id, $data['image'], 'blog');
                $data['image'] = config('upload.blog') . $id . '/' . $newName;
            }

            $dataBaseBlog = formatDataBaseOnTable('blogs', $data);
            $this->blogsRepository->update($id, $dataBaseBlog);

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
    public function randomBlog($number)
    {
        $result = $this->blogsRepository->getSomeRandomData($number);
        return $result;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getBlogLimit($limit)
    {
        $data = $this->blogsRepository->getDataLimit($limit)->get();
        return $data;
    }


    /**
     * Count blog
     * @return mixed
     */
    public function countBlog()
    {
        $data = $this->blogsRepository->countAll();
        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteBlog($id)
    {
        $delete = $this->blogsRepository->delete($id);
        return $delete;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restoreBlog($id)
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
    public function getAllTagsOfBlog($id)
    {
        $tags = $this->tagsRepository->getAllTagsOfBlog($id);
        return $tags;
    }

    /**
     * Save view blog
     * @param $blog
     * @param $view
     * @return mixed
     */
    public function saveViewBlog($blog, $view)
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
    public function getBlogViewJson($limit)
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