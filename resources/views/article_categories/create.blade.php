<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Kategori Artikel | N-MERCE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
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
            height: 200px;
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
            width: 100%;
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
    @include('articles.layouts.navigation')

    <div class="container mx-auto py-8 px-4">
        <h2 class="text-3xl font-bold mb-6 text-center">Buat Kategori Artikel</h2>
        <div class="bg-white shadow-md rounded-lg p-6">
            <form id="create-category-form" action="{{ route('article-categories.store') }}" method="POST"
                class="space-y-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Nama</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                        required>
                </div>
                <div class="flex justify-between">
                    <button type="button" id="cancel-button"
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200">Batal</button>
                    <button type="button" id="submit-button"
                        class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Buat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmationModal" class="modal flex">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="text-xl font-bold mb-4">Konfirmasi</h2>
            <p>Apakah kamu yakin ingin membuat kategori artikel?</p>
            <div class="flex justify-end mt-4">
                <button id="confirm-button"
                    class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Yes</button>
                <button id="close-modal"
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 ml-2">No</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var submitButton = document.getElementById('submit-button');
            var cancelButton = document.getElementById('cancel-button');
            var confirmationModal = document.getElementById('confirmationModal');
            var closeModal = document.getElementById('close-modal');
            var confirmButton = document.getElementById('confirm-button');

            submitButton.addEventListener('click', function() {
                if (validateForm()) {
                    confirmationModal.style.display = 'flex';
                }
            });

            cancelButton.addEventListener('click', function() {
                window.location.href = "{{ route('article-categories.index') }}";
            });

            closeModal.addEventListener('click', function() {
                confirmationModal.style.display = 'none';
            });

            confirmButton.addEventListener('click', function() {
                document.getElementById('create-category-form').submit();
            });

            // Close modal pada saat klik <span> (x)
            document.querySelector('.close').onclick = function() {
                confirmationModal.style.display = 'none';
            }

            // Close modal ketika klik diluar area modal
            window.onclick = function(event) {
                if (event.target == confirmationModal) {
                    confirmationModal.style.display = 'none';
                }
            }

            function validateForm() {
                const name = document.getElementById('name').value;

                if (!name) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Field nama harus diisi!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }

                return true;
            }

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
