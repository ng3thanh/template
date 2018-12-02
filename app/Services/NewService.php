<?php

namespace App\Services;

use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\NewsTranslate\NewsTranslateRepositoryInterface;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;

class NewService
{
    /**
     * @var NewsRepositoryInterface
     */
    protected $newsRepository;

    /**
     * @var NewsTranslateRepositoryInterface
     */
    protected $newsTransRepository;


    /**
     * NewService constructor.
     * @param NewsRepositoryInterface $newsRepository
     * @param NewsTranslateRepositoryInterface $newsTransRepository
     */
    public function __construct(
        NewsRepositoryInterface $newsRepository,
        NewsTranslateRepositoryInterface $newsTransRepository
    ) {
        $this->newsRepository = $newsRepository;
        $this->newsTransRepository = $newsTransRepository;
    }

    /**
     * Find blog
     *
     * @param $id
     * @return mixed
     */
    public function findNew($id)
    {
        $data = $this->newsRepository->find($id);
        return $data;
    }

    /**
     * Get all blog and paginate
     *
     * @return mixed
     */
    public function getAllNew($limit)
    {
        $data = $this->newsRepository->getAllPaginateWithTrash($limit);
        return $data;
    }

    /**
     * Get all blog and paginate to show in web
     *
     * @return mixed
     */
    public function getAllNewInWeb($limit)
    {
        $data = $this->newsRepository->getAllPaginate($limit);
        return $data;
    }

    /**
     * Find blog by id
     *
     * @param $id
     * @return mixed
     */
    public function findNewBySlugId($id)
    {
        $data = $this->newsRepository->findByIdRelatedSlug($id);
        return $data;
    }

    /**
     * @param $blog
     * @return mixed
     */
    public function findNewNext($blog)
    {
        $data = $this->newsRepository->getNewNextDate($blog->id, $blog->created_at);
        return $data;
    }

    /**
     * @param $blog
     * @return mixed
     */
    public function findNewPrevious($blog)
    {
        $data = $this->newsRepository->getNewPreviousDate($blog->id, $blog->created_at);
        return $data;
    }

    /**
     * Create new blog
     *
     * @param $data
     * @return bool
     */
    public function createNew($data)
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
            $dataMainNew = formatDataBaseOnTable('blogs', $data);
            $result = $this->newsRepository->create($dataMainNew);

            // Update image to base blog
            if ($result) {
                $newName = uploadImage($result->id, $file, 'blog');
                $this->newsRepository->update(
                    $result->id,
                    [
                        'image' => config('upload.blog') . $result->id . '/' . $newName
                    ]);
            }

            // Save translate data
            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $dataNewTrans = $value;
                $dataNewTrans['locale'] = $key;
                $dataNewTrans['blogs_id'] = $result->id;
                $this->newsTransRepository->create($dataNewTrans);
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
    public function updateNew($id, $data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['image'])) {
                $newName = uploadImage($id, $data['image'], 'blog');
                $data['image'] = config('upload.blog') . $id . '/' . $newName;
            }

            $dataBaseNew = formatDataBaseOnTable('blogs', $data);
            $this->newsRepository->update($id, $dataBaseNew);

            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $this->newsTransRepository->updateTrans('blogs_id', $id, $key, $value);
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
    public function randomNew($number)
    {
        $result = $this->newsRepository->getSomeRandomData($number);
        return $result;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getNewLimit($limit)
    {
        $data = $this->newsRepository->getDataLimit($limit)->get();
        return $data;
    }


    /**
     * Count blog
     * @return mixed
     */
    public function countNew()
    {
        $data = $this->newsRepository->countAll();
        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteNew($id)
    {
        $delete = $this->newsRepository->delete($id);
        return $delete;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restoreNew($id)
    {
        $delete = $this->newsRepository->restore($id);
        return $delete;
    }
    /**
     * Get all tags of blog
     *
     * @param $id
     * @return mixed
     */
    public function getAllTagsOfNew($id)
    {
        $tags = $this->tagsRepository->getAllTagsOfNew($id);
        return $tags;
    }

    /**
     * Save view blog
     * @param $blog
     * @param $view
     * @return mixed
     */
    public function saveViewNew($blog, $view)
    {
        try {
            DB::beginTransaction();
            $data = $this->newsRepository->update($blog->news_id, ['view' => $view]);
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
    public function getNewViewJson($limit)
    {
        $data = $this->newsRepository->getDataLimit($limit)->get();
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