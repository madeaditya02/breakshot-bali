<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search') ?? '';
        $menu = Menu::with('category')->where('name', 'like', "%$search%")->get();
        return Inertia::render('admin/menu/Index', ['menus' => $menu]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('admin/menu/Tambah', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'category' => ['required'],
            'image' => ['required', 'image'],
            'price' => ['required', 'numeric', 'min:0']
        ]);
        $data = $request->all();
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('image')->storeAs('menu', $fileName, 'public');
            $data['image'] = asset('storage/menu/'.$fileName);
        }
        $category = Category::find($data['category']);
        if (!$category) {
            $category = Category::create(['id' => $data['category'], 'name' => str($data['category'])->explode('-')->map(fn ($w) => str($w)->ucfirst())->implode(' ')]);
        }
        $data['category_id'] = $data['category'];
        if ($data['label'] == '') {
            unset($data['label']);
        }
        Menu::create($data);
        return to_route('admin.menu.index')->with('alert', ['title' => 'Menu berhasil ditambah', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    
    public function toggle(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->show = !$menu->show;
        $menu->save();
        return to_route('admin.menu.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::with('category')->findOrFail($id);
        $categories = Category::all();
        return Inertia::render('admin/menu/Edit', [
            'menu' => $menu,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => ['required'],
            'category' => ['required'],
            'price' => ['required', 'numeric', 'min:0']
        ];
        if ($request->file('image')) {
            $rules['image'] = ['image'];
        }
        $request->validate($rules);
        $menu = Menu::findOrFail($id);

        $data = $request->all();
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time().".$extension";
            $path = $request->file('image')->storeAs('menu', $fileName, 'public');
            $data['image'] = asset('storage/menu/'.$fileName);
        }
        $category = Category::find($data['category']);
        if (!$category) {
            $category = Category::create(['id' => $data['category'], 'name' => str($data['category'])->explode('-')->map(fn ($w) => str($w)->ucfirst())->implode(' ')]);
        }
        $data['category_id'] = $data['category'];
        // if ($data['label'] == '') {
        //     unset($data['label']);
        // }
        $menu->update($data);
        return to_route('admin.menu.index')->with('alert', ['title' => 'Menu berhasil didiedittambah', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Menu::destroy($id);
        return to_route('admin.menu.index')->with('alert', ['title' => 'Menu berhasil dihapus', 'type' => 'success']);
    }
}
