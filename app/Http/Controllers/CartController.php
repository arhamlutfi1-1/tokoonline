<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id'
        ]);

        $product = Produk::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // Check if product already in cart
        $productExists = false;
        foreach ($cart as $item) {
            if ($item['produk_id'] == $product->id) {
                $productExists = true;
                break;
            }
        }

        if ($productExists) {
            return redirect()->back()->with('error', 'Produk sudah ada di keranjang!');
        }

        // Add new product to cart with quantity = 1
        $cart[] = [
            'produk_id' => $product->id,
            'produk_name' => $product->produk_name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->getFirstMediaUrl('product_images'),
        ];

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['produk_id'] == $request->produk_id) {
                $cart[$index]['quantity'] = $request->quantity;
                break;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui!');
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'produk_id' => 'required'
        ]);

        $cart = session()->get('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['produk_id'] == $request->produk_id) {
                unset($cart[$index]);
                break;
            }
        }

        // Re-index array
        $cart = array_values($cart);

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    /**
     * Clear all items from cart
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan!');
    }
}