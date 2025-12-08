@extends('layout')
@section('content')
@php
    $produk = App\Models\Produk::first();
@endphp

  <section class="text-gray-600 body-font">
  <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
      <img class="border-5 border-gray-600 object-cover  object-center rounded-full" alt="hero" src={{ $produk->getFirstMediaUrl('product_images') }}>
    </div>
    <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">{{ $produk->nama_barang }}
      </h1>
      <p class="mb-8 leading-relaxed">{{ $produk->product_description_short }}</p>
      <div class="flex justify-center">
        <a href="" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Beli</a>
        <a href="" class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Pesan Sekarang</a>
      </div>
    </div>
  </div>
</section>

<section class="text-gray-600 body-font overflow-hidden">
  <h2 class="text-3xl font-medium text-gray-900 title-font  text-center">Daftar Produk</h2>
  <div class="container px-5 py-24 mx-auto">
    
     @php
    $produk = App\Models\Produk::all();
@endphp
       @foreach ($produk as $produk)
      <div class="py-8 flex flex-wrap md:flex-nowrap">
        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
        <img class="h-48 w-48 border-3 border-gray-300 p-3 object-cover object-center rounded-full" alt="hero" src={{ $produk->getFirstMediaUrl('product_images') }}>
          <span class="font-semibold title-font text-gray-700">CATEGORY</span>
          <span class="text-sm text-gray-500">12 Jun 2019</span>
        </div>
        <div class="md:flex-grow">
          <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{$produk->nama_barang}}</h2>
          <p class="leading-relaxed">{{$produk->product_description_short}}</p>
          <a href="{{route('product.detail', $produk->id)}}" class="text-indigo-500 inline-flex items-center mt-4">Lihat Detail
            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>

      
  
    @endforeach
  </div>
</section>
@endsection
