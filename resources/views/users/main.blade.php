@extends('layouts.mainLayout')

@section('title', 'Home | N-MERCE')

@section('content')
<style>
    .clamp-2 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2; /* Jumlah baris yang ditampilin */
    }
    .clamp-3 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
    }
    @media (min-width: 1030px) {
        .clamp-3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 3;
        }
    }
</style>
    <!-- Hero Section -->
    <section class="relative flex flex-col items-center justify-center bg-cover bg-center text-white py-24" id="jumbotron"
        style="background-image: url('{{ asset('images/jumbotron4.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-20"></div> <!-- Overlay -->

        <div class="container relative z-10 mx-auto text-center">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4">Discover The Greatest Products <br>FOR YOU.</h1>
            <form method="GET" action="{{ route('home') }}" class="flex justify-center mb-4">
                <input type="text" id="search" name="search" placeholder="Search for products"
                    class="border border-gray-300 rounded-l px-4 py-2 sm:w-full max-w-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all duration-300 text-gray-800">
                <button type="submit"
                    class="bg-purple-600 text-white px-4 py-2 rounded-r hover:bg-purple-700 transition-all duration-300">Search</button>
            </form>
        </div>
    </section>

    <!-- Produk Terbaru -->
    <section class="container mx-auto mt-6 mb-4">
        <h2 class="text-2xl font-bold mb-4 bg-white p-6 shadow-md">Produk Terbaru</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($latestProducts as $product)
                <div class="bg-white p-5 shadow-md flex flex-col">
                    <h3 class="mb-2 text-lg font-bold">{{ $product->category ? $product->category->name : 'Uncategorized' }}
                    </h3>
                    <a href="{{ route('products.show', $product->id) }}" class="flex justify-center items-center h-48 mb-4">
                        <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->name }}"
                            class="max-h-full max-w-full mt-auto loading="lazy">
                    </a>
                    <h3 class="text-xl font-semibold mb-2 clamp-2">{{ $product->name }}</h3>
                    <p class="description2 mb-4  mt-auto clamp-2" data-full-description="{{ $product->description }}"></p>
                    <a href="{{ route('products.show', $product->id) }}"
                        class="bg-white hover:bg-black hover:text-white py-2 px-4  border mt-auto text-center w-1/2 mx-auto">Detail
                        Produk</a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- List produk -->
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4 bg-white p-6 shadow-md">Rekomendasi</h2>
        <div class="relative">
            <button id="prev"
                class="absolute left-0 top-1/3 transform -translate-y-1/2 bg-white border border-gray-300 p-2 rounded-full shadow-md focus:outline-none">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <div id="product-list" class="flex overflow-x-auto scroll-smooth space-x-4 pb-12">
                @foreach ($AllProducts as $product)
                    <div class="bg-white p-5 shadow-md overflow-hidden w-80 md:w-80 flex-shrink-0 flex flex-col">
                        <h3 class="mb-2 text-lg font-bold">
                            {{ $product->category ? $product->category->name : 'Uncategorized' }}</h3>
                        <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Step 1"
                            class="mx-auto h-64 w-64 lg:h-64 lg:w-full mb-4 mt-auto loading="lazy">
                        </a>
                            <!--lg:max-h-full lg:max-w-full INI UNTUK UKURAN YANG PAS-->
                        <h3 class="text-xl font-semibold mb-2 mt-auto clamp-2">{{ $product->name }}</h3>
                        <p class="description mb-4 clamp-2" data-full-description="{{ $product->description }}"></p>
                        <a href="{{ route('products.show', $product->id) }}"
                            class="bg-white hover:bg-black hover:text-white border py-2 px-4 mt-auto text-center">Detail
                            Produk</a>
                    </div>
                @endforeach
            </div>
            <button id="next"
                class="absolute right-0 top-1/3 transform -translate-y-1/2 bg-white border border-gray-300 p-2 rounded-full shadow-md focus:outline-none">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Semua Produk -->
    <section class="bg-white py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4 bg-white p-6 shadow-md">Semua Produk</h2>
            <div id="product-list2">
                @include('partials.mainProducts', ['products' => $products])
            </div>
            <div id="pagination-links" class="mt-6">
                {{ $products->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>

    @include('layouts.article')
    @include('layouts.footer')
@endsection
