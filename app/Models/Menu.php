<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'url', 'parent_id', 'is_active'];

    // Relasi untuk menu induk (parent)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Relasi untuk menu anak
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
