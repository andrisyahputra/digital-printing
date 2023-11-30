<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pembeli()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function created_at_id(){
        return Carbon::parse($this->created_at)->locale('id')->isoFormat('dddd DD-MM-YYYY HH:mm');
    }
    public function dikirim(){
        $pk = PesananDikirim::firstWhere('order_id', $this->order_id);
        return (object) [
            'resi'=> $pk->resi,
            'expedisi'=> $pk->expedisi
        ];
    }
}
