@extends('layouts.homeLayout')

@section('title' ,'Shop | N-MERCE')

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
    <!-- Konten Utama -->
    <main class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center rounded-md mb-4 bg-white p-6">
            <h2 class="text-2xl font-bold">
                @if (request('search'))
                    Hasil Pencarian Untuk "{{ request('search') }}"
                @else
                    Hello, {{ Auth::user()->name }}
                @endif
            </h2>
            <span id="total-products" class="text-gray-600">
                Total Produk : {{ $products->total() }}
            </span>
        </div>

        <div class="flex flex-col lg:flex-row">
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4 lg:pr-4 mb-4 lg:mb-0">
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <h3 class="font-bold text-lg pb-6 border-b">
                        Filter Kategori
                    </h3>
                    <form method="GET" action="{{ route('home') }}" id="filterForm">
                        <select name="category_id" id="category_id"
                            class="py-2 px-4 mt-6 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="my-6 border-t border-b py-6">
                            @foreach ($categories as $category)
                                <div class="flex items-center mb-2 custom-checkbox">
                                    <input id="category-{{ $category->id }}" name="category[]" value="{{ $category->id }}"
                                        type="checkbox" class="h-4 w-4"
                                        {{ in_array($category->id, (array) request('category')) ? 'checked' : '' }} />
                                    <label for="category-{{ $category->id }}" class="ml-3 min-w-0 flex-1 text-gray-700">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <label for="min_price" class="block text-gray-700 font-medium mb-2">
                                Minimal Harga
                            </label>
                            <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}"
                                class="py-2 px-4 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>

                        <div class="mt-4">
                            <label for="max_price" class="block text-gray-700 font-medium mb-2">
                                Maksimal Harga
                            </label>
                            <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}"
                                class="py-2 px-4 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>

                        <div class="mt-8 flex justify-between border-t pt-8">
                            <button type="button" id="clear-filters"
                                class="border border-gray-300 px-4 py-2 rounded hover:bg-black hover:text-white w-full">
                                Clear Filter
                            </button>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- List Produk -->
            <section class="w-full lg:w-3/4">
                @if ($products->isEmpty())
                    <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
                        <h3 class="text-lg font-bold text-gray-700">
                            Produk Tidak Ada
                        </h3>
                    </div>
                @else
                    <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($products as $product)
                            <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
                                <h3 class="mb-2 text-lg font-bold">
                                    {{ $product->category ? $product->category->name : 'Uncategorized' }}
                                </h3>
                                <a href="{{ route('products.show', $product->id) }}" class="mb-4">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover mb-4" />
                                </a>
                                <h3 class="text-lg font-bold clamp-2">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-gray-600 description clamp-2" data-full-description="{{ $product->description }}">
                                </p>
                                <div class="mt-auto">
                                    <p class="text-lg font-bold">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="text-purple-500 hover:text-purple-800">
                                        Detail Produk
                                    </a>
                                    <form id="add-to-cart-form-{{ $product->id }}"
                                        class="grid grid-2 gap-4 mt-4 bg-white add-to-cart-form initialized"
                                        data-product-id="{{ $product->id }}">
                                        @csrf
                                        <div class="flex items-center space-x-2">
                                            <label for="quantity-{{ $product->id }}" class="text-gray-700">
                                                Jumlah:
                                            </label>
                                            <input type="number" id="quantity-{{ $product->id }}" name="quantity"
                                                value="1" min="1"
                                                class="w-full text-end p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-purple-600 hover:bg-purple-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                                            + Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($products->hasMorePages())
                        <div class="mt-4 text-center">
                            <button id="show-more-button"
                                class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-800 transition duration-200"
                                data-next-page="{{ $products->currentPage() + 1 }}">
                                Show more
                            </button>
                        </div>
                    @endif
                @endif
            </section>
        </div>
    </main>
    @include('layouts.footer')
@endsection
