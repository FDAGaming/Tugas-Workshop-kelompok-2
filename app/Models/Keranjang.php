<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable = ['kuantitas', 'obat_id', 'user_id'];
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
