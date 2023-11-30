<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function keranjangs()
    {
        return $this->hasMany(kerajang::class, 'produk_id');
    }

    public function kurangi_stok($stok)
    {
        $this->stok = $this->stok - $stok;
        $this->save();
    }
    public function tambahi_stok($stok)
    {
        $this->stok = $this->stok + $stok;
        $this->save();
    }
}
