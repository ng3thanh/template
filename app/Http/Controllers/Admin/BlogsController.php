<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Models\Blogs;
use App\Services\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestParameter;

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
        $limit = config('constant.number.blog.paginate.admin');
        $number = (RequestParameter::get('page','1') - 1)* $limit + 1;
        $blogs = $this->blogService->getAllBlog($limit);
        return view('admin.pages.blogs.index', compact('blogs', 'number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param BlogPostRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(BlogPostRequest $request) {
        $data = $request->except('_token');
        $result = $this->blogService->createBlog($data);
        if ($result) {
            return redirect()->route('blog.index')->with('success', 'Create new data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when save data')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function copy($id)
    {
        $blog = $this->blogService->findBlog($id);
        return view('admin.pages.blogs.copy', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogs $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogs $blog)
    {
        return view('admin.pages.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Blogs $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogs $blog)
    {
        $data = $request->except('_token', '_method');
        $result = $this->blogService->updateBlog($blog->id, $data);
        if ($result) {
            return redirect()->route('blog.index')->with('success', 'Update data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update data')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogs $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogs $blog)
    {
        $result = $this->blogService->deleteBlog($blog->id);
        if ($result) {
            return redirect()->route('blog.index')->with('success', 'Delete data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when delete data')->withInput();
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $result = $this->blogService->restoreBlog($id);
        if ($result) {
            return redirect()->route('blog.index')->with('success', 'Restore data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when restore data')->withInput();
        }
    }
}
