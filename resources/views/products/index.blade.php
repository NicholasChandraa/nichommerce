<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Produk | N-MERCE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
        @media (max-width: 768px) {
            .responsive-table {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .responsive-table thead,
            .responsive-table tbody,
            .responsive-table th,
            .responsive-table td,
            .responsive-table tr {
                display: block;
            }

            .responsive-table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .responsive-table tr {
                border: 1px solid #ddd;
            }

            .responsive-table td {
                border: none;
                border-bottom: 1px solid #ddd;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            .responsive-table td:before {
                position: absolute;
                top: 50%;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                transform: translateY(-50%);
                text-align: left;
                font-weight: bold;
            }

            .responsive-table td:before {
                content: attr(data-label);
            }
        }
    </style>
</head>

<body class="bg-gray-100">

    {{-- navigation --}}
    @include('products.layouts.navigation')

    <div class="container mx-auto py-8 px-4">
        <!-- Filter and Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <form method="GET" action="{{ url('/products') }}"
                class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Filter Kategori</label>
                    <select name="category_id" id="category_id"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="relative">
                    <label for="search" class="block text-sm font-medium text-gray-700">Cari Produk</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="absolute inset-y-11 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.9 14.32a8 8 0 111.414-1.414l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387zM8 14a6 6 0 100-12 6 6 0 000 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </form>
            <a href="/manageArticles"
                class="px-4 py-2 mt-4 lg:mt-auto font-semibold bg-purple-500 hover:bg-purple-600 text-white rounded-lg">Manage
                Artikel</a>
        </div>

        <!-- Table Produk -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
             <div class="overflow-x-auto">
            <table class="min-w-full bg-white responsive-table">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        @php
                            $columns = [
                                'name' => 'Nama',
                                'category_id' => 'Kategori',
                                'description' => 'Deskripsi',
                                'price' => 'Harga',
                                'stock' => 'Stok',
                                'created_at' => 'Tanggal',
                            ];

                            $sort_icon_asc = 'fas fa-sort-up';
                            $sort_icon_desc = 'fas fa-sort-down';
                        @endphp

                        <th class="py-3 px-4 text-left">
                            <a href="{{ url('/products?') . http_build_query(request()->except('sort_by', 'sort_order') + ['sort_by' => 'name', 'sort_order' => $sort_by == 'name' && $sort_order == 'asc' ? 'desc' : 'asc']) }}"
                                class="flex items-center">
                                Nama
                                @if ($sort_by == 'name')
                                    @if ($sort_order == 'asc')
                                        <i class="{{ $sort_icon_asc }} ml-1"></i>
                                    @else
                                        <i class="{{ $sort_icon_desc }} ml-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-4 text-left">
                            <a href="{{ url('/products?') . http_build_query(request()->except('sort_by', 'sort_order') + ['sort_by' => 'category_id', 'sort_order' => $sort_by == 'category_id' && $sort_order == 'asc' ? 'desc' : 'asc']) }}"
                                class="flex items-center">
                                Kategori
                                @if ($sort_by == 'category_id')
                                    @if ($sort_order == 'asc')
                                        <i class="{{ $sort_icon_asc }} ml-1"></i>
                                    @else
                                        <i class="{{ $sort_icon_desc }} ml-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-4 text-left">Deskripsi</th>
                        <th class="py-3 px-4 text-left">
                            <a href="{{ url('/products?') .
                                http_build_query(
                                    request()->except('sort_by', 'sort_order') + [
                                        'sort_by' => 'price',
                                        'sort_order' =>
                                            $sort_by == 'price' &&
                                            $sort_order ==
                                                'asc
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    '
                                                ? 'desc'
                                                : 'asc',
                                    ],
                                ) }}"
                                class="flex items-center">
                                Harga
                                @if ($sort_by == 'price')
                                    @if ($sort_order == 'asc')
                                        <i class="{{ $sort_icon_asc }} ml-1"></i>
                                    @else
                                        <i class="{{ $sort_icon_desc }} ml-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-4 text-left">
                            <a href="{{ url('/products?') . http_build_query(request()->except('sort_by', 'sort_order') + ['sort_by' => 'stock', 'sort_order' => $sort_by == 'stock' && $sort_order == 'asc' ? 'desc' : 'asc']) }}"
                                class="flex items-center">
                                Stok
                                @if ($sort_by == 'stock')
                                    @if ($sort_order == 'asc')
                                        <i class="{{ $sort_icon_asc }} ml-1"></i>
                                    @else
                                        <i class="{{ $sort_icon_desc }} ml-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-4 text-left">
                            <a href="{{ url('/products?') . http_build_query(request()->except('sort_by', 'sort_order') + ['sort_by' => 'created_at', 'sort_order' => $sort_by == 'created_at' && $sort_order == 'asc' ? 'desc' : 'asc']) }}"
                                class="flex items-center">
                                Tanggal
                                @if ($sort_by == 'created_at')
                                    @if ($sort_order == 'asc')
                                        <i class="{{ $sort_icon_asc }} ml-1"></i>
                                    @else
                                        <i class="{{ $sort_icon_desc }} ml-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($products as $product)
                        <tr class="border-b">
                            <td class="py-3 px-4" data-label="Nama">{{ $product->name }}</td>
                            <td class="py-3 px-4" data-label="Kategori">
                                {{ $product->category ? $product->category->name : 'Uncategorized' }}</td>
                            <td class="py-3 px-4" data-label="Deskripsi">{{ Str::limit($product->description, 50) }}
                            </td>
                            <td class="py-3 px-4" data-label="Harga">
                                Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4" data-label="Stok">{{ $product->stock }}</td>
                            <td class="py-3 px-4" data-label="Tanggal">{{ $product->created_at->format('d-m-Y') }}</td>
                            <td class="py-3 px-4" data-label="Image">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 object-cover rounded-lg">
                                @endif
                            </td>
                            <td class="py-3 px-4 flex flex-col space-y-2 space-x-2 md:space-x-0" data-label="Aksi">
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 transition duration-200 text-center">
                                    <i class="fas fa-eye"></i> View</a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600 transition duration-200 text-center">
                                    <i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition duration-200 text-center delete-button">
                                        <i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>    
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Kamu tidak akan bisa memulihkan data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Check untuk 'success' session dan show SweetAlert
            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                // Clear untuk success session jadi tidak muncul pada page reload
                {{ session()->forget('success') }}
            @endif
        });
    </script>
    @vite('resources/js/app.js')
</body>

</html>
