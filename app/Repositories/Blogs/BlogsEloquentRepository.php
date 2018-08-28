<?php

namespace App\Repositories\Blogs;

use App\Models\Blogs;
use App\Repositories\Base\BaseEloquentRepository;

class BlogsEloquentRepository extends BaseEloquentRepository implements BlogsRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Blogs::class;
    }

    /**
     * Find by id related slug
     * @param $id
     * @return mixed
     */
    public function findByIdRelatedSlug($id)
    {
        $locale = app()->getLocale();
        $result = $this->model->join('blogs_translate', 'blogs_translate.blogs_id', '=', 'blogs.id')
            ->where('blogs_translate.blogs_id', $id)
            ->where('blogs_translate.locale', $locale)
            ->first();
        return $result;
    }

    public function getBlogNextDate($id, $date)
    {
        $result = $this->model->where('created_at', '>=', $date)
            ->where('id', '!=', $id)
            ->first();
        return $result;
    }

    public function getBlogPreviousDate($id, $date)
    {
        $result = $this->model->where('created_at', '<=', $date)
            ->where('id', '!=', $id)
            ->first();
        return $result;
    }

//    public function getAllBlogPaginate($limit)
//    {
//        $result = $this->model->paginate($limit);
//
//        return $result;
//    }
}
