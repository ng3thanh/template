<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestParameter;

class ProductsController extends Controller
{
    /**
     * @var ProductsService
     */
    protected $productService;

    /**
     * ProductsController constructor.
     * @param ProductsService $productService
     */
    public function __construct(
        ProductsService $productService
    ) {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = config('constant.number.product.paginate.admin');
        $number = (RequestParameter::get('page','1') - 1)* $limit + 1;
        $products = $this->productService->getAllProduct($limit);
        return view('admin.pages.products.index', compact('products', 'number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductsPostRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(ProductsPostRequest $request) {
        $data = $request->except('_token');
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
