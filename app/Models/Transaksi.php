<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function created_at_id(){
        return Carbon::parse($this->created_at)->locale('id')->isoFormat('dddd DD-MM-YYYY HH:mm');
    }
}
