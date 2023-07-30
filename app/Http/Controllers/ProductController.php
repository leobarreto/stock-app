<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function list()
    {
        $products = $this->model->getProduct(request('search'));
        $categories = Category::all();

        return view('products.list', ['products' => $products, 'categories' => $categories]);
    }

    public function store(StoreProductRequest $request)
    {
        $this->model->storeProduct($request->all());

        return redirect()
                ->route('products.list')
                ->with('msg', 'Produto cadastrado com sucesso');
    }

    public function edit($id)
    {
        $product = $this->model->findOrFail($id);
        $categories = Category::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(StoreProductRequest $request, $id)
    {
        $data = $request->validated();

        $data['price'] = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->price)));

        $product = $this->model->findOrFail($id);

        $product->update($data);

        return redirect()
                ->route('products.list')
                ->with('msg', 'Produto atualizado com sucesso');
    }

    public function destroy($id)
    {
        $product = $this->model->findOrFail($id);

        $product->delete();

        return redirect()
                ->route('products.list')
                ->with('msg', 'Produto excluído com sucesso');
    }
}
