<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsPostRequest;
use App\Models\News;
use App\Services\NewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestParameter;

class NewsController extends Controller
{
    /**
     * @var NewService
     */
    protected $newService;

    /**
     * NewsController constructor.
     * @param NewService $newService
     */
    public function __construct(
        NewService $newService
    ) {
        $this->newService = $newService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = config('constant.number.new.paginate.admin');
        $number = (RequestParameter::get('page','1') - 1)* $limit + 1;
        $news = $this->newService->getAllNews($limit);
        return view('admin.pages.new.index', compact('news', 'number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.new.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param NewsPostRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(NewsPostRequest $request) {
        $data = $request->except('_token');
        $result = $this->newService->createNews($data);
        if ($result) {
            return redirect()->route('new.index')->with('success', 'Create new data successfully!');
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
        $new = $this->newService->findNews($id);
        return view('admin.pages.new.copy', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News $new
     * @return \Illuminate\Http\Response
     */
    public function edit(News $new)
    {
        return view('admin.pages.new.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\News $new
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $new)
    {
        $data = $request->except('_token', '_method');
        $result = $this->newService->updateNews($new->id, $data);
        if ($result) {
            return redirect()->route('new.index')->with('success', 'Update data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update data')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News $new
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $new)
    {
        $result = $this->newService->deleteNew($new->id);
        if ($result) {
            return redirect()->route('new.index')->with('success', 'Delete data successfully!');
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
        $result = $this->newService->restoreNew($id);
        if ($result) {
            return redirect()->route('new.index')->with('success', 'Restore data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when restore data')->withInput();
        }
    }
}
