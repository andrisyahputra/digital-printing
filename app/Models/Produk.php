<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ConvertContentImageBase64ToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    use ConvertContentImageBase64ToUrl;
    protected $guarded = ['id'];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->removeOldImages($model->attributes['deskripsi']);
        });
    }

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
        // if ($this->stok - $stok >= 0) {
        //     $this->stok = $this->stok - $stok;
        //     $this->save();
        // } else {
        //     // Handle the case where the resulting stock is negative
        //     // You can throw an exception, log an error, or take appropriate action
        //     // return redirect()->back()->with('error', $this->nama . ' stok ini tidak mencukupi');
        //     throw new \Exception('Not enough stock available.');
        // }
    }
    public function tambahi_stok($stok)
    {
        $this->stok = $this->stok + $stok;
        $this->save();
    }
}
