<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'N-MERCE Page')</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
</head>
<style>
    #jumbotron {
        height: 40vh;
        z-index: 10;
    }

    @media (min-width: 768px) {
        #jumbotron {
            height: 55vh;
            z-index: 10;
        }
    }

    .scroll-smooth::-webkit-scrollbar {
        display: none;
    }
</style>

<body class="bg-gray-100">
    
<!-- Header -->
<header class="bg-white shadow-md relative z-50">
    <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center space-x-4 mb-4 md:mb-0 mr-3">
            <a href="{{ url('/') }}" class="lg:text-2xl font-bold">
                N-MERCE
            </a>
        </div>
        <nav class="flex space-x-4 items-center">
            <a href="{{ route('main') }}" class="text-gray-700 hover:text-purple-500">
                Home
            </a>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-500">
                Shop
            </a>
            <a href="/about" class="text-gray-700 hover:text-purple-500">
                About
            </a>
            <a href="/articlePages" class="text-gray-700 hover:text-purple-500 text-center">
                Articles
            </a>
            <div class="relative flex items-center space-x-4">
                @if (Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}"
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full object-cover cursor-pointer"
                        onclick="toggleMenu(event)" />
                    <img src="{{ asset('images/dropdownGudang.png') }}" alt="drop down gudang"
                        class="w-4 object-cover cursor-pointer" onclick="toggleMenu(event)" />
                @endif

                <!-- Profile Menu -->
                <div id="menu" class="hidden absolute top-full right-0 mt-2 w-[200px] bg-white shadow-md py-3 sm:p-4 mb-4 space-y-4 z-10">
                    <ul>
                        <li class="w-44">
                            <a href="{{ route('user.profile') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-purple-50">
                                Settings
                            </a>
                        </li>
                        @if (Auth::user()->role === 'admin')
                            <li>
                                <a href="{{ route('products.index') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-purple-50">
                                    Manage Products
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('manageArticles') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-purple-50">
                                    Manage Articles
                                </a>
                            </li>
                        @endif

                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-purple-50">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

    <!-- Main Content -->
    @yield('content')

    <script>
        // Toggle menu mobile
        function toggleMenu() {
            document.getElementById('menu').classList.toggle('hidden');
        }

        // untuk list produk
        document.getElementById('next').onclick = function() {
            document.getElementById('product-list').scrollBy({
                left: 600,
                behavior: 'smooth',
            });
        };

        document.getElementById('prev').onclick = function() {
            document.getElementById('product-list').scrollBy({
                left: -600,
                behavior: 'smooth',
            });
        };

        // Close menu ketika klik apapun di luar menu
        document.addEventListener('click', function(event) {
            var menu = document.getElementById('menu');
            var isClickInsideMenu = menu.contains(event.target);
            var isClickOnToggle = event.target.closest(
                '.flex.items-center.relative',
            );

            if (!isClickInsideMenu && !isClickOnToggle) {
                menu.classList.add('hidden');
            }
        });

        // Untuk batasan jumlah deskripsi
        document.addEventListener('DOMContentLoaded', function() {
            const descriptions = document.querySelectorAll('.description');
            const descriptions2 =
                document.querySelectorAll('.description2');
                
            descriptions.forEach((description) => {
                const fullDescription = description.getAttribute(
                    'data-full-description',
                );
                const words = fullDescription.split(' ');
                if (words.length > 10) {
                    const truncated = words.slice(0, 20).join(' ') + '...';
                    description.textContent = truncated;
                } else {
                    description.textContent = fullDescription;
                }
            });

            descriptions2.forEach((description) => {
                const fullDescription = description.getAttribute(
                    'data-full-description',
                );
                const words = fullDescription.split(' ');
                if (words.length > 10) {
                    const truncated = words.slice(0, 20).join(' ') + '...';
                    description.textContent = truncated;
                } else {
                    description.textContent = fullDescription;
                }
            });
        });

        // Untuk Jumbotron
        document.addEventListener('DOMContentLoaded', function() {
            const images = [
                '{{ asset('images/jumbotron4.jpg') }}',
                '{{ asset('images/jumbotron5.jpg') }}',
                '{{ asset('images/jumbotron3.jpg') }}',
                '{{ asset('images/jumbotron6.jpg') }}',
            ];

            let currentIndex = 0;
            const jumbotron = document.getElementById('jumbotron');

            function changeImage() {
                currentIndex = (currentIndex + 1) % images.length;
                jumbotron.style.backgroundImage = `url('${images[currentIndex]}')`;
            }

            setInterval(changeImage, 3000);
        });

        // Pagination
        document.addEventListener('DOMContentLoaded', function() {
            function fetchProducts(url) {
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById('product-list2').innerHTML =
                            data.products;
                        document.getElementById(
                            'pagination-links',
                        ).innerHTML = data.pagination;
                        attachPaginationEvents();
                    });
            }

            function attachPaginationEvents() {
                document
                    .querySelectorAll('#pagination-links a')
                    .forEach(function(link) {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            var url = this.href;
                            fetchProducts(url);
                        });
                    });
            }

            attachPaginationEvents();
        });
    </script>
    @vite('resources/js/app.js')
</body>

</html>
