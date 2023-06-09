<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus= Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        // $menus= Menu::all();
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $req)
    {
        $image = $req->file('image')->store("public/menus");
        $menu= Menu::create([
            "name"=> $req->name,
            "description"=> $req->description,
            "price"=> $req->price,
            "image"=> $image,
        ]);
        //pivot relationship store
        if($req->has('categories')){
            $menu->categories()->attach($req->categories);
        }

        return redirect()->route('admin.menus.index')->with('success', 'New Menu Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $categories= Category::all();
        return view('admin.menus.edit', compact("menu", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Menu $menu)
    {
        $req->validate([
            "name" => ['required'],
            "description" => ['required'],
            "price" => ['required'],
        ]);

        $image = $menu->image;
        if ($req->hasFile('image')) {
            Storage::delete("$image");
            $image = $req->file('image')->store("public/menus");
        }
        $menu->update([
            "name" => $req->name,
            "description" => $req->description,
            "image" => $image,
            "price"=> $req->price
        ]);
        //pivot relationship update
        if ($req->has('categories')) {
            $menu->categories()->sync($req->categories);
        }
        return redirect()->route('admin.menus.index')->with('success', 'Menu successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Storage::delete($menu->image);
        $menu->categories()->detach();
        $menu->delete();
        return back()->with('danger', 'Menu successfully deleted!');
    }
}
