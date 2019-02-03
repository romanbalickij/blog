<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    public function index(){

     $categories = Category::all();
     return view('admin.categories.index', compact('categories'));
    }

    public function create(){

        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request){

      Category::create($request->all());
      return redirect()->route('categories.index');
    }

    public function edit(Category $category){

        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request,Category $category){

      $category->update($request->all());
      return redirect()->route('categories.index');
    }

    public function destroy($id){
        Category:: findOrFail($id)->delete();
        return back();
    }
}
