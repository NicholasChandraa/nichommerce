@foreach($products as $product)
<div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
    <h3 class="mb-2 text-lg font-bold">{{$product->category ? $product->category->name : "Uncategorized"}}</h3>
    <a href="{{ route('products.show', $product->id) }}" class="mb-4">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover mb-4" />
                                </a>
    <h3 class="text-lg font-bold clamp-2">{{ $product->name }}</h3>
    <p class="text-gray-600 description clamp-2" data-full-description="{{ $product->description }}"></p>
    <div class="mt-auto">
        <p class="text-lg font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
        <a href="{{ route('products.show', $product->id) }}" class="text-purple-500 hover:text-purple-800">Detail Produk</a>
        <form id="add-to-cart-form-{{ $product->id }}" class="grid grid-2 gap-4 mt-4 bg-white add-to-cart-form" data-product-id="{{ $product->id }}">
            @csrf
            <div class="flex items-center space-x-2">
                <label for="quantity-{{ $product->id }}" class="text-gray-700">Jumlah:</label>
                <input type="number" id="quantity-{{ $product->id }}" name="quantity" value="1" min="1" class="w-full text-end p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">+ Keranjang</button>
        </form>
    </div>
</div>
@endforeach