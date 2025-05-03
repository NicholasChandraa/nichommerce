<!-- resources/views/partials/mainProducts.blade.php -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach ($products as $product)
    <div class="p-5 border shadow-md flex flex-col">
        <h3 class="mb-4 text-lg font-bold">{{ $product->category ? $product->category->name : "Uncategorized" }}</h3>
        <a href="{{ route('products.show', $product->id) }}" class="flex justify-center items-center h-48 lg:h-80">
            <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->name }}" class="mx-auto mb-4 h-full object-cover" loading="lazy">
        </a>
        <h3 class="text-xl font-semibold mb-2 clamp-2">{{ $product->name }}</h3>
        <p class="description2 mb-4 clamp-2" data-full-description="{{ $product->description }}"></p>
        <a href="{{ route('products.show', $product->id) }}" class="bg-white hover:bg-black hover:text-white border py-2 px-4 mt-auto text-center">Detail Produk</a>
    </div>
    @endforeach
</div>