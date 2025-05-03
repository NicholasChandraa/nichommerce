<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'N-MERCE | Shop')</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
    <style>
        .custom-checkbox input[type='checkbox'] {
            accent-color: rgb(139 92 246);
        }

        .custom-checkbox label {
            color: #333333;
        }
    </style>
</head>

<body class="bg-gray-100">
<!-- Header -->
<header class="bg-white shadow-md">
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
            <a href="{{ url('/cart') }}" class="text-gray-700 hover:text-purple-500 text-center md:pr-5 lg:pr-0 pr-2">
                Keranjang (
                <span id="cart-count">
                    {{ $cart ? $cart->cartItems->count() : 0 }}
                </span>
                )
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
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50">
                                Settings
                            </a>
                        </li>
                        @if (Auth::user()->role === 'admin')
                            <li>
                                <a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50">
                                    Manage Products
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('manageArticles') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50">
                                    Manage Articles
                                </a>
                            </li>
                        @endif

                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-purple-50">
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

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Toggle menu mobile
        function toggleMenu() {
            document.getElementById('menu').classList.toggle('hidden');
        }

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

        document.addEventListener('DOMContentLoaded', function() {
            // untuk filter
            const filterForm = document.getElementById('filterForm');
            document
                .querySelectorAll('#filterForm input')
                .forEach((input) => {
                    input.addEventListener('change', function() {
                        filterForm.submit();
                    });
                });

            document
                .getElementById('category_id')
                .addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });

            document
                .getElementById('min_price')
                .addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });

            document
                .getElementById('max_price')
                .addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });

            document
                .getElementById('clear-filters')
                .addEventListener('click', function() {
                    document.getElementById('category_id').selectedIndex =
                        0;
                    document
                        .querySelectorAll(
                            '#filterForm input[type=checkbox]',
                        )
                        .forEach((checkbox) => (checkbox.checked = false));
                    document.getElementById('min_price').value = '';
                    document.getElementById('max_price').value = '';
                    document.getElementById('filterForm').submit();
                });

            function truncateDescriptions() {
                const descriptions =
                    document.querySelectorAll('.description');
                descriptions.forEach((description) => {
                    const fullDescription = description.getAttribute(
                        'data-full-description',
                    );
                    const words = fullDescription.split(' ');
                    if (words.length > 10) {
                        const truncated =
                            words.slice(0, 10).join(' ') + '...';
                        description.textContent = truncated;
                    } else {
                        description.textContent = fullDescription;
                    }
                });
            }

            function initializeAddToCartForms() {
                const forms =
                    document.querySelectorAll('.add-to-cart-form');
                const cartCountElement =
                    document.getElementById('cart-count');

                forms.forEach((form) => {
                    if (!form.classList.contains('initialized')) {
                        form.classList.add('initialized');

                        form.addEventListener('submit', function(event) {
                            event.preventDefault();

                            const productId =
                                form.getAttribute('data-product-id');
                            const quantityInput = form.querySelector(
                                'input[name="quantity"]',
                            );
                            const quantity = quantityInput.value;

                            axios
                                .post(`/cart/add/${productId}`, {
                                    quantity: quantity,
                                    _token: '{{ csrf_token() }}',
                                })
                                .then((response) => {
                                    console.log('Product added to cart');
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Product added to cart',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                    });
                                    // Reset quantity input ke 1
                                    quantityInput.value = 1;
                                    // Update hitung keranjang
                                    cartCountElement.textContent =
                                        response.data.cartItemCount;
                                })
                                .catch((error) => {
                                    console.error(
                                        'There was an error!',
                                        error,
                                    );
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There was an error adding the product to the cart.',
                                        icon: 'error',
                                        confirmButtonText: 'OK',
                                    });
                                });
                        });
                    }
                });
            }

            truncateDescriptions();
            initializeAddToCartForms();

            // Untuk fitur "Show More"
            const showMoreButton =
                document.getElementById('show-more-button');
            if (showMoreButton) {
                showMoreButton.addEventListener('click', function() {
                    const nextPage = this.getAttribute('data-next-page');
                    axios
                        .get('{{ route('home') }}', {
                            params: {
                                page: nextPage,
                                category_id: '{{ request('category_id') }}',
                                search: '{{ request('search') }}',
                                min_price: '{{ request('min_price') }}',
                                max_price: '{{ request('max_price') }}',
                            },
                        })
                        .then((response) => {
                            const productList =
                                document.getElementById('product-list');
                            productList.insertAdjacentHTML(
                                'beforeend',
                                response.data.products,
                            );

                            // Update total produk
                            const totalProductsElement =
                                document.getElementById('total-products');
                            totalProductsElement.textContent =
                                'Total: ' + response.data.total;

                            // Truncate deskripsi untuk produk baru
                            truncateDescriptions();

                            // Inisialisasi ulang form "Add to Cart"
                            initializeAddToCartForms();

                            // untuk mengecek apakah ada page lagi yang tersedia
                            if (!response.data.hasMorePages) {
                                showMoreButton.remove();
                            } else {
                                showMoreButton.setAttribute(
                                    'data-next-page',
                                    parseInt(nextPage) + 1,
                                );
                            }
                        })
                        .catch((error) => {
                            console.error(
                                'Error loading more products:',
                                error,
                            );
                        });
                });
            }
        });

        // Untuk add to cart agar page tidak refresh saat tambah produk ke keranjang
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.add-to-cart-form');
            const cartCountElement = document.getElementById('cart-count');

            forms.forEach((form) => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const productId = form.getAttribute('data-product-id');
                    const quantityInput = form.querySelector(
                        'input[name="quantity"]',
                    );
                    const quantity = quantityInput.value;

                    axios
                        .post(`/cart/add/${productId}`, {
                            quantity: quantity,
                            _token: '{{ csrf_token() }}',
                        })
                        .then((response) => {
                            console.log('Product added to cart');
                            Swal.fire({
                                title: 'Success!',
                                text: 'Product added to cart',
                                icon: 'success',
                                confirmButtonText: 'OK',
                            });
                            // Reset quantity input ke 1
                            quantityInput.value = 1;
                            // Update hitung keranjang
                            cartCountElement.textContent =
                                response.data.cartItemCount;
                        })
                        .catch((error) => {
                            console.error('There was an error!', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error adding the product to the cart.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                            });
                        });
                });
            });
        });
    </script>
    @vite('resources/js/app.js')
</body>

</html>
