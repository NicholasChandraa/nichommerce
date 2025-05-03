<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk | N-MERCE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .image-preview {
            width: 100%;
            height: 100%;
            border: 2px dashed #ddd;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-bottom: 10px;
            position: relative;
        }

        .image-preview img {
            width: 50%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview label {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100">

    {{-- navigation --}}
    @include('products.layouts.navigation')

    <div class="flex items-center justify-center min-h-screen p-5">
        <div class="bg-white shadow-md rounded-lg p-5 w-full max-w-3xl">
            <h1 class="text-3xl font-bold mb-6 text-center">Edit Produk</h1>
            <form id="edit-product-form" method="POST" action="{{ route('products.update', $product->id) }}"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Nama</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}"
                        class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                        required>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-semibold">Kategori</label>
                    <select id="category_id" name="category_id"
                        class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                        required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                        required>{{ $product->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold">Harga dalam rupiah (Rp.)</label>
                    <input type="text" id="price" name="price"
                        value="{{ number_format($product->price, 0, ',', '') }}"
                        class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                        required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold">Stok</label>
                    <input type="text" id="stock" name="stock" value="{{ $product->stock }}"
                        class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                        required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold">Image</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full p-2 border border-gray-300 rounded mt-2 mb-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    <div class="image-preview" id="imagePreview">
                        <label for="image">Choose Image</label>
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : '' }}" alt="Image Preview"
                            class="{{ $product->image ? '' : 'hidden' }}" />
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="button" id="cancel-button"
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200">Batal</button>
                    <button type="button" id="submit-button"
                        class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700 transition duration-200">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmationModal" class="modal flex">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="text-xl font-bold mb-4">Konfirmasi</h2>
            <p>Kamu yakin ingin memperbarui produk?</p>
            <div class="flex justify-end mt-4">
                <button id="confirm-button"
                    class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700 transition duration-200">Yes</button>
                <button id="close-modal"
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 ml-2">No</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#category_id').select2({
                placeholder: 'Pilih Kategori',
                allowClear: true
            });

            var submitButton = document.getElementById('submit-button');
            var cancelButton = document.getElementById('cancel-button');
            var confirmationModal = document.getElementById('confirmationModal');
            var closeModal = document.getElementById('close-modal');
            var confirmButton = document.getElementById('confirm-button');
            var imageInput = document.getElementById('image');
            var imagePreview = document.getElementById('imagePreview');
            var imagePreviewImg = imagePreview.querySelector('img');
            var imagePreviewLabel = imagePreview.querySelector('label');

            submitButton.addEventListener('click', function() {
                // Validasi angka untuk price dan stock
                var price = document.getElementById('price').value.replace(/\./g, '');
                var stock = document.getElementById('stock').value;
                var category_id = document.getElementById('category_id').value;

                if (category_id === "") {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Category harus dipilih.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (isNaN(price) || isNaN(stock) || price <= 0 || stock <= 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Harga dan stok harus dalam bentuk angka dan lebih besar dari 0.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                confirmationModal.style.display = 'flex';
            });

            cancelButton.addEventListener('click', function() {
                window.location.href = "{{ route('products.index') }}";
            });

            closeModal.addEventListener('click', function() {
                confirmationModal.style.display = 'none';
            });

            confirmButton.addEventListener('click', function() {
                document.getElementById('edit-product-form').submit();
            });

            // Close modal ketika klik tanda (x)
            document.querySelector('.close').onclick = function() {
                confirmationModal.style.display = 'none';
            }

            // Close modal ketika klik area diluar modal
            window.onclick = function(event) {
                if (event.target == confirmationModal) {
                    confirmationModal.style.display = 'none';
                }
            }

            // Image preview
            imageInput.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();

                    imagePreviewLabel.style.display = 'none';
                    imagePreviewImg.style.display = 'block';

                    reader.addEventListener('load', function() {
                        imagePreviewImg.setAttribute('src', this.result);
                    });

                    reader.readAsDataURL(file);
                } else {
                    imagePreviewLabel.style.display = null;
                    imagePreviewImg.style.display = null;
                    imagePreviewImg.setAttribute('src', '');
                }
            });

            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    @vite('resources/js/app.js')
</body>

</html>