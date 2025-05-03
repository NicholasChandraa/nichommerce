@extends('layouts.homeLayout')

@section('title', "N-MERCE | $product->name")

@section('content')
    <style>
        .quantity-input {
            width: 3rem;
            text-align: center;
        }

        .hidden {
            display: none;
        }

        .read-more {
            color: rgb(168 85 247);
            cursor: pointer;
        }

        .similar-product-img {
            width: 100%;
            height: auto;
            max-height: 240px;
        }

        @media (min-width: 768px) {
            .similar-product-img {
                max-height: 320px;
            }
        }

        @media (min-width: 1024px) {
            .similar-product-img {
                max-height: 384px;
            }
        }
    </style>

    <!-- Product Detail Section -->
    <section class="py-16 bg-white border-t">
        <div class="container mx-auto px-4 lg:px-0">
            <!-- Breadcrumbs -->
            <div class="mb-4 flex justify-between items-center">
                <nav class="text-sm text-gray-600">
                    <a href="/" class="hover:underline">Home</a> &gt;
                    <a href="/home" class="hover:underline">All Products</a> &gt;
                    <span>Product Details</span>
                </nav>
                <a href="/home" class="bg-gray-200 hover:bg-gray-300 text-gray-600 px-4 py-1 rounded-full">Kembali</a>
            </div>
            <div class="lg:flex lg:space-x-16">
                <!-- Product Image -->
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <img class="rounded-[30px] shadow-lg w-full lg:h-[650px]"
                        src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
                <!-- Product Information -->
                <div class="lg:w-1/2 p-8 flex flex-col">
                    <h2 class="text-3xl font-semibold mb-4">{{ $product->name }}</h2>
                    <p class="text-lg text-gray-500">
                        {{ $product->category ? $product->category->name : 'Uncategorized' }}</p>
                    <div class="lg:mb-10 lg:px-12 pt-7 mt-7 border-t pb-7 mb-7 border-b">

                        {{-- Deskripsi, spannya sengaja dempet biar setelah ... tidak ada spasi --}}
                        <div class="text-md text-gray-700 text-justify indent-8" id="product-description">
                            {{ Str::limit($product->description, 100, '') }}<span id="dots">...</span><span
                                id="more" class="hidden">{{ substr($product->description, 100) }}</span>
                        </div>
                        <span class="read-more text-blue-500 cursor-pointer" id="read-more-btn"
                            onclick="toggleDescription()">Read more</span>
                    </div>
                    <div class="">
                        <div class="flex items-center justify-between mb-4">
                            <span
                                class="text-2xl font-bold text-gray-700">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            <p class="text-lg text-gray-500 ">
                                Stok: {{ $product->stock }}</p>
                        </div>
                        <form id="add-to-cart-form-{{ $product->id }}"
                            class="grid grid-2 gap-4 mt-4 bg-white add-to-cart-form initialized"
                            data-product-id="{{ $product->id }}">
                            @csrf
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center space-x-2">
                                    <label for="quantity-{{ $product->id }}" class="text-gray-700">
                                        Jumlah:
                                    </label>
                                    <button type="button" onclick="changeQuantity({{ $product->id }}, -1)"
                                        class="px-2 py-1 border rounded-md">-</button>
                                    <input type="number" id="quantity-{{ $product->id }}" name="quantity" value="1"
                                        min="1"
                                        class="w-full text-center p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        readonly />
                                    <button type="button" onclick="changeQuantity({{ $product->id }}, 1)"
                                        class="px-2 py-1 border rounded-md">+</button>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full bg-purple-600 hover:bg-purple-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                                + Keranjang
                            </button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- Produk Lainnya -->
            <div class="mt-16 border-t pt-10">
                <h3 class="text-2xl font-bold mb-4">Produk Serupa</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 border-b pb-10 mb-10">
                    @foreach ($similarProducts as $similarProduct)
                        <div class="bg-white p-4 rounded-lg text-center shadow-md border">
                            <a href="{{ route('products.show', $similarProduct->id) }}">
                                <img class="similar-product-img rounded-[20px] object-cover mb-4"
                                    src="{{ asset('storage/' . $similarProduct->image) }}"
                                    alt="{{ $similarProduct->name }}">
                                <h4 class="text-lg font-bold mb-2">{{ $similarProduct->name }}</h4>
                            </a>
                            <p class="text-gray-500 mb-2">Rp{{ number_format($similarProduct->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">{{ $similarProduct->category->name ?? 'Uncategorized' }}</p>
                        </div>
                    @endforeach
                </div>
                <div>
                    <a href="/home" class="bg-gray-200 hover:bg-gray-300 text-gray-600 px-4 py-2 rounded">Back to
                        Products</a>
                </div>
            </div>
    </section>
    <script>
        function toggleDescription() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("read-more-btn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.classList.add("hidden");
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.classList.remove("hidden");
            }
        }

        function changeQuantity(productId, delta) {
            var quantityInput = document.getElementById('quantity-' + productId);
            var currentQuantity = parseInt(quantityInput.value);
            var newQuantity = currentQuantity + delta;
            if (newQuantity < 1) {
                newQuantity = 1;
            }
            quantityInput.value = newQuantity;
        }
    </script>
    @include('layouts.footer')
@endsection
