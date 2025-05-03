<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'N-Merce Page')</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
</head>

<body class="bg-white">

    <!-- Header -->
<header class="bg-white shadow-md relative z-50">
    <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center space-x-4 mb-4 md:mb-0 mr-3">
            <a href="{{ url('/') }}" class="lg:text-2xl font-bold">
                N-MERCE
            </a>
            <form method="GET" action="{{ url('/home') }}" class="flex items-center relative">
                <div class="absolute inset-y-0 right-20 sm:left-0 sm:pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    class="pl-4 sm:pl-10 p-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-purple-200"
                    placeholder="Cari produk..." />
                <button type="submit"
                    class="bg-purple-600 text-white h-[42px] p-2 rounded-r hover:bg-purple-700 transition duration-200">
                    Search
                </button>
            </form>
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
    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <script>
        // Toggle menu mobile
        function toggleMenu() {
            document.getElementById('menu').classList.toggle('hidden');
        }

        // Close menu ketika klik apapun di luar menu
        document.addEventListener('click', function(event) {
            var menu = document.getElementById('menu');
            var isClickInsideMenu = menu.contains(event.target);
            var isClickOnToggle = event.target.closest('.flex.items-center.relative');

            if (!isClickInsideMenu && !isClickOnToggle) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
