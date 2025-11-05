<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model implements \Spatie\MediaLibrary\HasMedia
{
    use \Spatie\MediaLibrary\InteractsWithMedia;
    protected $table = 'produk';
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'tgl_masuk',
        'quantity',
        'price'
    ];
}
