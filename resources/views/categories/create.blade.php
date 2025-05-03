<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kategori | N-MERCE</title>
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
    </style>
</head>

<body class="bg-gray-100">

    {{-- navigation --}}
    @include('products.layouts.navigation')

    <div class="container mx-auto py-8 px-4">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg mx-auto">
            <h2 class="text-2xl font-bold mb-4 text-center">Buat Kategori</h2>
            <form id="create-category-form" action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                        required>
                </div>
                <div class="flex justify-between">
                    <button type="button" id="cancel-button"
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200">Batal</button>
                    <button type="button" id="submit-button"
                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Buat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmationModal" class="modal flex">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="text-xl font-bold mb-4">Konfirmasi</h2>
            <p>Yakin ingin buat kategori?</p>
            <div class="flex justify-end mt-4">
                <button id="confirm-button"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Ya</button>
                <button id="close-modal"
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 ml-2">Tidak</button>
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
                confirmationModal.style.display = 'flex';
            });

            cancelButton.addEventListener('click', function() {
                window.location.href = "{{ route('categories.index') }}";
            });

            closeModal.addEventListener('click', function() {
                confirmationModal.style.display = 'none';
            });

            confirmButton.addEventListener('click', function() {
                document.getElementById('create-category-form').submit();
            });

            // Close modal ketika user klik <span> (x)
            document.querySelector('.close').onclick = function() {
                confirmationModal.style.display = 'none';
            }

            // Close modal ketika user klik diluar modal
            window.onclick = function(event) {
                if (event.target == confirmationModal) {
                    confirmationModal.style.display = 'none';
                }
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
