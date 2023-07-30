<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $model;
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function create()
    {
        return view('categories.create');
    }

    public function list()
    {
        $categories = $this->model->all();

        return view('categories.list', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = $request->all();

        $this->model->create($category);

        return redirect()
                ->route('categories.list')
                ->with('msg', 'Categoria criada com sucesso');
    }

    public function destroy($id)
    {
        $category = $this->model->findOrFail($id);

        $category->delete();

        return redirect()
                ->route('categories.list')
                ->with('msg', 'Categoria excluída com sucesso');
    }
}
