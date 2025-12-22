@extends('layout')
@section('content')

@php
    $featured = App\Models\Produk::latest()->first();
    $products = App\Models\Produk::latest()->get();
@endphp

<div class="bg-gradient-to-b from-gray-50 to-white">
    {{-- HERO / FEATURED PRODUCT --}}
    @if($featured)
    <section class="container mx-auto px-5 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="order-2 md:order-1">
                <div class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-4 py-2 text-indigo-700 text-sm font-medium">
                    <span class="h-2 w-2 rounded-full bg-indigo-600"></span>
                    Produk Pilihan Hari Ini
                </div>

                <h1 class="mt-4 text-3xl md:text-5xl font-bold tracking-tight text-gray-900">
                    {{ $featured->nama_barang }}
                </h1>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    {{ $featured->product_description_short }}
                </p>

                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ route('product.detail', $featured->id) }}"
                       class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-white font-semibold shadow-sm hover:bg-indigo-700 transition">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <a href="#produk"
                       class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-gray-900 font-semibold ring-1 ring-gray-200 hover:ring-gray-300 hover:bg-gray-50 transition">
                        Lihat Semua Produk
                    </a>
                </div>
            </div>

            <div class="order-1 md:order-2">
                <div class="relative overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-100">
                    @php $img = $featured->getFirstMediaUrl('product_images'); @endphp
                    <img
                        src="{{ $img ?: 'https://placehold.co/1200x900?text=No+Image' }}"
                        alt="{{ $featured->nama_barang }}"
                        class="h-[340px] md:h-[420px] w-full object-cover"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-black/0 to-transparent"></div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- PRODUCT LIST --}}
    <section id="produk" class="container mx-auto px-5 pb-16">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Daftar Produk</h2>
                <p class="mt-1 text-gray-600">Pilih produk yang kamu suka, lihat detail, lalu checkout.</p>
            </div>

            {{-- (opsional) Tombol kecil --}}
            <a href="#"
               class="hidden sm:inline-flex items-center rounded-xl bg-gray-900 px-4 py-2 text-white text-sm font-semibold hover:bg-gray-800 transition">
                Promo
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $p)
                @php
                    $img = $p->getFirstMediaUrl('product_images');
                @endphp

                <div class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 hover:shadow-lg transition">
                    <a href="{{ route('product.detail', $p->id) }}" class="block">
                        <div class="relative overflow-hidden">
                            <img
                                src="{{ $img ?: 'https://placehold.co/1200x900?text=No+Image' }}"
                                alt="{{ $p->nama_barang }}"
                                class="h-56 w-full object-cover group-hover:scale-105 transition duration-300"
                            />
                            <div class="absolute top-3 left-3">
                                <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-gray-900 ring-1 ring-gray-200">
                                    Produk
                                </span>
                            </div>
                        </div>
                    </a>

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 line-clamp-1">
                            {{ $p->nama_barang }}
                        </h3>

                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                            {{ $p->product_description_short }}
                        </p>

                        <div class="mt-5 flex items-center justify-between gap-3">
                            <a href="{{ route('product.detail', $p->id) }}"
                               class="inline-flex items-center text-indigo-600 font-semibold hover:text-indigo-700 transition">
                                Detail
                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $p->id }}">
    <button type="submit"
        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-white text-sm font-semibold hover:bg-indigo-700 transition">
        Beli
    </button>
</form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

@endsection
