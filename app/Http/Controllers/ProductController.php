<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id)
    {
        $produk = \App\Models\Produk::find($id);
        return view('product.detail', compact('produk'));
    }
}
