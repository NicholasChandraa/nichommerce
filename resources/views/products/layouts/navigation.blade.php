<!-- Navigation -->
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-800">
            <a href="/products">Manajemen Produk</a>
        </div>
        <div class="hidden md:flex space-x-4 items-center">
            <a
                href="{{ route("products.create") }}"
                class="text-gray-600 hover:text-gray-800 border-r pr-4 lg:pr-6"
            >
                Buat Produk
            </a>
            <a
                href="{{ route("categories.index") }}"
                class="text-gray-600 hover:text-gray-800 border-r pr-4 lg:pr-6"
            >
                Halaman Kategori
            </a>
            <a
                href="{{ route("admin.order_history") }}"
                class="text-gray-600 hover:text-gray-800 border-r pr-4 lg:pr-6"
            >
                Histori Order
            </a>
            <a href="/" class="text-gray-600 hover:text-gray-800">Home</a>
        </div>
        <button
            id="burger"
            class="md:hidden bg-gray-800 text-white p-2 rounded focus:outline-none"
        >
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
        <a
            href="{{ route("products.create") }}"
            class="block text-gray-600 hover:text-gray-800 py-2 border-b"
        >
            Buat Produk
        </a>
        <a
            href="{{ route("categories.index") }}"
            class="block text-gray-600 hover:text-gray-800 py-2 border-b"
        >
            Halaman Kategori
        </a>
        <a
            href="{{ route("admin.order_history") }}"
            class="block text-gray-600 hover:text-gray-800 py-2 border-b"
        >
            Histori Order
        </a>
        <a href="/" class="block text-gray-600 hover:text-gray-800 py-2">
            Home
        </a>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const burger = document.getElementById('burger');
        const mobileMenu = document.getElementById('mobile-menu');

        burger.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>
