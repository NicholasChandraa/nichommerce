<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori List | N-MERCE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #f4f5f7;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .header .btn-group {
            display: flex;
            gap: 10px;
        }

        .header .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .header .btn-primary {
            background-color: #3490dc;
        }

        .header .btn-primary:hover {
            background-color: #2779bd;
        }

        .header .btn-secondary {
            background-color: #6c757d;
        }

        .header .btn-secondary:hover {
            background-color: #5a6268;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #122a42;
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .card-header h3 {
            margin: 0;
            font-size: 20px;
            color: #ffffff;
        }

        .card-body {
            padding: 15px;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .table th {
            background-color: #f1f1f1;
            text-align: left;
            font-weight: 600;
        }

        .table td {
            background-color: #fff;
        }

        .table td.actions {
            display: flex;
            gap: 10px;
        }

        .table .btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .table .btn-primary {
            background-color: #3490dc;
        }

        .table .btn-primary:hover {
            background-color: #2779bd;
        }

        .table .btn-danger {
            background-color: #e3342f;
        }

        .table .btn-danger:hover {
            background-color: #cc1f1a;
        }

        @media (max-width: 768px) {
            .header h2 {
                font-size: 20px;
            }

            .header .btn {
                padding: 8px 16px;
                font-size: 14px;
            }

            .card-header h3 {
                font-size: 18px;
            }

            .table th,
            .table td {
                padding: 10px 12px;
            }

            .table .btn {
                padding: 6px 10px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .header .btn-group {
                flex-direction: column;
                gap: 5px;
            }

            .table th,
            .table td {
                font-size: 12px;
            }

            .table .btn {
                padding: 4px 8px;
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

    {{-- navigation --}}
    @include('products.layouts.navigation')

    <div class="container">
        <div class="header">
            <div class="btn-group">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>
            <div class="btn-group">
                <a href="{{ url('products') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Produk
                </a>
            </div>
        </div>
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4 flex items-center">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header font-semibold">
                <h3>List Kategori</h3>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="actions">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit mr-2 pt-1"></i> Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-button">
                                                <i class="fas fa-trash-alt mr-2 pt-1"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
        });
    </script>

    @vite('resources/js/app.js')
</body>

</html>
