<?php

namespace App\Models;
use App\Models\Cateogory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractWithMedia;

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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'produk_id', 'category_id');
    }
}
