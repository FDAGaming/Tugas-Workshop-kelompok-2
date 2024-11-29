<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->get();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->get();
        return view('menus.create', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:menus,slug',
            'url' => 'nullable|url',
            'parent_id' => 'nullable|exists:menus,id',
            'is_active' => 'required|boolean',
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')->get();
        return view('menus.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:menus,slug,' . $menu->id,
            'url' => 'nullable|url',
            'parent_id' => 'nullable|exists:menus,id',
            'is_active' => 'required|boolean',
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index');
    }
}

