<footer class="bg-gray-900 text-white">
    <div class="flex items-center justify-center py-16 px-3 h-auto lg:h-[400px]">
        <div class="text-center">
            <p class="text-sm text-green-500 mb-4">SAFETY AND COMFORT ON EVERY JOURNEY.</p>
            <h1 class="text-3xl font-bold mb-6">Start using N-MERCE today.</h1>
            <div class="relative mb-6">
                <form method="GET" action="{{ route('home') }}" class="flex justify-center mb-4">
                    <input type="text" id="search" name="search" placeholder="Search for products"
                        class="w-full py-2 pl-4 pr-12 text-black rounded-md" />
                    <button type="submit"
                        class="absolute right-0 top-0 h-full px-4 bg-pink-500 text-white rounded-r-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v16h16M4 4L16 16M4 4L8 16M8 16L16 16" />
                        </svg>
                    </button>
                </form>
            </div>
            <img src="{{ asset('images/footer5.webp') }}" alt="footer" alt="NJS Logo"
                class="gambar mx-auto mb-4 w-[500px] rounded">
        </div>
    </div>

    <div class="bg-gray-800 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between">
                <div class="mb-4 lg:mb-0">
                    <h2 class="text-xl font-bold mb-2">N-MERCE</h2>
                    <p class="text-gray-400">Our Products, Protecting You with Style and the Latest Innovation!</p>
                </div>
                <div class="flex flex-wrap lg:flex-no-wrap">
                    <div class="mr-8 mb-4 lg:mb-0">
                        <h3 class="text-lg font-bold mb-2">Tentang Kami</h3>
                        <ul>
                            <li><a href="/about" class="text-gray-400 hover:text-white">About</a>
                            </li>
                            <li><a href="/" class="text-gray-400 hover:text-white">Home</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mr-8 mb-4 lg:mb-0">
                        <h3 class="text-lg font-bold mb-2">Produk</h3>
                        <ul>
                            <li><a href="/home" class="text-gray-400 hover:text-white">Shop</a></li>
                            <li><a href="/articlePages" class="text-gray-400 hover:text-white">Article</a></li>
                        </ul>
                    </div>
                    <div class="mb-4 lg:mb-0">
                        <h3 class="text-lg font-bold mb-2">Hubungi Kami</h3>
                        <a href="https://wa.me/6285156495716" target="_blank" class="text-gray-400 hover:text-white">+62
                            85156495716</a>
                        <div class="flex space-x-4 mt-2">
                            <a href="https://www.facebook.com/nic.nicholasjr/" target="_blank"
                                class="text-gray-400 hover:text-white">
                                <i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/nichochandr/" target="_blank"
                                class="text-gray-400 hover:text-white">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <p class="text-sm text-gray-400">© 2024 nichommerce. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </div>
</footer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
