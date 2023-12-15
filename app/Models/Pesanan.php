<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pembeli()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function created_at_id()
    {
        return Carbon::parse($this->created_at)->locale('id')->isoFormat('dddd DD-MM-YYYY HH:mm');
    }
    public function dikirim()
    {
        $pk = PesananDikirim::firstWhere('order_id', $this->order_id);
        return (object) [
            'resi' => $pk->resi,
            'expedisi' => $pk->expedisi,
            'paket' => $pk->paket
        ];
    }
    public function diterima()
    {
        $pk = PesananDiterima::firstWhere('order_id', $this->order_id);
        return (object) [
            'foto' => $pk->foto,
        ];
    }
    /**
     * Get all of the foto_pesanans for the Pesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foto_pesanans(): HasMany
    {
        return $this->hasMany(FotoPesanan::class, 'pesanan_id');
    }

    public function tranksaksi()
    {
        $pk = Transaksi::firstWhere('order_id', $this->order_id);
        return (object) [
            'url_payment' => $pk->url_payment,
        ];
    }

    // public
}
