<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use Carbon\Carbon;

class BlogsController extends Controller
{
    /**
     * @var BlogService
     */
    protected $blogService;

    /**
     * BlogsController constructor.
     * @param BlogService $blogService
     */
    public function __construct(
        BlogService $blogService
    ) {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogList = $this->blogService->getAllBlogInWeb(config('constant.number.blog.paginate.web'));
        return view('web.pages.blogs.list', compact('blogList'));
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, $slug)
    {
        // Get slug data
        $blog = $this->blogService->findBlogBySlugId($id);

        // Save view list
        $blog->addViewWithExpiryDate(Carbon::now()->addMinute(10));
        $view = $blog->getViews();

        if ($blog->view != $view) {
            $blog = $this->blogService->saveViewBlog($blog, $view);
        }

        $blogNext = $this->blogService->findBlogNext($blog);
        $blogPrevious = $this->blogService->findBlogPrevious($blog);
        $randomBlog = $this->blogService->randomBlog(config('constant.number.blog.random'));

        return view('web.pages.blogs.detail', compact('blog', 'randomBlog', 'blogNext', 'blogPrevious'));
    }
}
