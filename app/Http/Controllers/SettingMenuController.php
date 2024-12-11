<?php

namespace App\Http\Controllers;

use App\Models\SettingMenu;
use App\Models\Role;
use App\Models\Menu;
use Illuminate\Http\Request;

class SettingMenuController extends Controller
{
    public function index()
{
    $role = Role::all();
    $menus = Menu::all();
    $settingMenus = SettingMenu::with('menu', 'Role')->get();
    return view('dashboard.setting_menus.index', compact('role', 'menus', 'settingMenus'));
}

    public function create()
{

    $Roles = Role::all();
    $menus = Menu::all();

    return view('dashboard.setting_menus.create', compact('Roles', 'menus'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'role_id' => 'required|exists:roles,id',
        'menu_id' => 'required|array',
        'menu_id.*' => 'exists:menus,id',
    ]);

    foreach ($validated['menu_id'] as $menuId) {
        SettingMenu::create([
            'role_id' => $validated['role_id'],
            'menu_id' => $menuId,
        ]);
    }

    return redirect()->route('setting_menus.index')->with('success', 'Setting Menu berhasil ditambahkan');
}


public function edit($id)
{
    $settingMenu = SettingMenu::where('role_id', $id)->get();

    $Roles = Role::all();
    $menus = Menu::all();

    $selectedMenus = $settingMenu->pluck('menu_id')->toArray();

    return view('dashboard.setting_menus.edit', compact('settingMenu', 'Roles', 'menus', 'selectedMenus'));
}



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'role_id' => 'required',
            'menu_id' => 'required|array',
        ]);

        SettingMenu::where('role_id', $id)->delete();

        foreach ($validated['menu_id'] as $menuId) {
            SettingMenu::create([
                'role_id' => $validated['role_id'],
                'menu_id' => $menuId,
            ]);
        }

        return redirect()->route('setting_menus.index')->with('success', 'Setting Menu berhasil diupdate');
    }

    public function destroy($id)
    {
        SettingMenu::where('role_id', $id)->delete();
        return redirect()->route('setting_menus.index')->with('success', 'Setting Menu berhasil dihapus');
    }
}