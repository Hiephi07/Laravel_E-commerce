<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Menus;

use App\Components\MenuRicusive;

class MenusController extends Controller
{
    private $menuRicusive;
    function __construct(MenuRicusive $menuRicusive){
        $this->menuRicusive = $menuRicusive;
    }
    function index(){
        $menus = Menus::take(5)->paginate(5);

        return view("admin.menus.index", compact("menus"));
    }

    function create(){
        $optionSelect = $this->menuRicusive->menuRicusiveAdd();
        return view("admin.menus.add", compact('optionSelect'));
    }

    function store(Request $request){
        $validateData = $request->validate([
            "name" => "required|max:255",
            "parent_id"=> "required",
        ]);

        $menus = new Menus();

        $menus->name       = $validateData['name'];
        $menus->parent_id  = $validateData['parent_id'];
        $menus->menu_slugs = STR::slug($menus->name);

        $menus->save();

        return redirect('/admin/menus');
    }

    function edit($id){
        $menu = Menus::find($id);
        $optionSelected = $this->menuRicusive->menuRicusiveEdit($menu->parent_id);
        return view('admin.menus.edit', compact('menu', 'optionSelected'));
    }

    function update($id, Request $request){
        $validateData = $request->validate([
            "name" => "required|max:255",
            "parent_id"=> "required",
        ]);

        $menu = Menus::find($id);

        $menu->update([
            "name" => $validateData["name"],
            "parent_id"=> $validateData["parent_id"],
            "menu_slugs" => STR::slug($validateData["name"]),
        ]);

        return redirect('/admin/menus');
    }

    function delete($id){
        Menus::find($id)->delete();

        return redirect('/admin/menus');
    }
}
