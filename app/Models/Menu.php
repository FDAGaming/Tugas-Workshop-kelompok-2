<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'link_menu',
        'icon_menu',
    ];
    public function settingMenus()
    {
        return $this->hasMany(SettingMenu::class, 'menu_id');
    }
}