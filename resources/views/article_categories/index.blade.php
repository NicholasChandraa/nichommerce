<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori Artikel | N-MERCE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons form {
            display: inline-block;
        }

        .action-buttons a,
        .action-buttons button {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .action-buttons a {
            color: #1D4ED8;
            background-color: #E0F2FE;
        }

        .action-buttons a:hover {
            background-color: #BFDBFE;
        }

        .action-buttons button {
            color: #DC2626;
            background-color: #FEE2E2;
        }

        .action-buttons button:hover {
            background-color: #FCA5A5;
        }
    </style>
</head>

<body class="bg-gray-100">

    {{-- navigation --}}
    @include('articles.layouts.navigation')

    <div class="container mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold">Kategori Artikel</h2>
            <a href="{{ route('article-categories.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">Buat
                Kategori</a>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Nama</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($categories as $category)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $category->name }}</td>
                            <td class="py-3 px-4">
                                <div class="action-buttons">
                                    <a href="{{ route('article-categories.edit', $category->id) }}"
                                        class="text-blue-600 hover:text-blue-800 transition duration-200">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>
                                    <form action="{{ route('article-categories.destroy', $category->id) }}"
                                        method="POST" onsubmit="return confirmDeletion(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition duration-200">
                                            <i class="fas fa-trash-alt"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="/manageArticles"
            class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200">Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeletion(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Menghapus kategori, akan menghapus semua produk yang memiliki kategori ini, dan tidak bisa dipulihkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    @vite('resources/js/app.js')
</body>

</html>
