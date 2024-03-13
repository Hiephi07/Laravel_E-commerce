<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str; //chuyển đổi một chuỗi thành dạng "slug", tức là chuỗi không có dấu và khoảng trắng

// use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categories::take(5)->paginate(5);
        return view("categories.index", compact("categories"));
    }
    function create(){
        return view("categories.add");
    }

    function store(Request $request){
        $validateData = $request->validate([
            "name" => "required|max:255",
        ]);

        $category = new Categories();

        // Lấy dữ liệu trực tiếp từ request
        // $category->name = $request->name;

        // Lấy dữ liệu thông qua Validate
        $category->name = $validateData['name'];

        $category->slug = Str::slug($category->name);
        $category->save();

        return redirect('/categories');
    }

    function edit($id){
        $category = Categories::find($id);
        return view('categories.edit', compact('category'));
    }

    function update($id, Request $request){
        $validateData = $request->validate([
            "name" => "required|max:255"
        ]);

        $category = Categories::find($id);

        $category->update([
            "name" => $validateData["name"]
        ]);

        return redirect('/categories');
    }

    function delete($id){
        Categories::find($id)->delete();

        return redirect('/categories');
    }
}
