<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestParameter;
use App\Http\Requests\ProductsPostRequest;

class ProductsController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * @var MenuService
     */
    protected $menuService;

    /**
     * ProductsController constructor.
     * @param ProductService $productService
     * @param MenuService $menusService
     */
    public function __construct(
        ProductService $productService,
        MenuService $menusService
    ) {
        $this->productService = $productService;
        $this->menuService = $menusService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        if (!isset($data['search'])) {
            $data['publish'] = null;
        }
        $languages = config('constant.language');
        $menu = $this->menuService->getMenuForSelectBox();
        $products = $this->productService->getAdminProductIndex($data);
        return view('admin.pages.products.index', compact('products', 'languages', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages  = config('constant.language');
        $origin     = config('constant.origin');
        $mass       = config('constant.mass');
        $quantity   = config('constant.quantity');
        $menu = $this->menuService->getMenuForSelectBox();
        return view('admin.pages.products.create', compact('languages', 'menu', 'mass', 'quantity', 'origin'));
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductsPostRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(ProductsPostRequest $request) {
        $data = $request->except('_token');
        dd($data);
        $result = $this->productService->createProduct($data);
        if ($result) {
            return redirect()->route('product.index')->with('success', 'Create new data successfully!');
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
        $product = $this->productService->findProduct($id);
        return view('admin.pages.products.copy', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Products $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $data = $request->except('_token', '_method');
        $result = $this->productService->updateProduct($product->id, $data);
        if ($result) {
            return redirect()->route('product.index')->with('success', 'Update data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update data')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $result = $this->productService->deleteProduct($product->id);
        if ($result) {
            return redirect()->route('product.index')->with('success', 'Delete data successfully!');
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
        $result = $this->productService->restoreProduct($id);
        if ($result) {
            return redirect()->route('product.index')->with('success', 'Restore data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when restore data')->withInput();
        }
    }
}
