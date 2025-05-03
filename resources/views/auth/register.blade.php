<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>N-MERCE | Daftar</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-md rounded-lg flex flex-col md:flex-row max-w-4xl p-5 md:p-0">
            <div class="md:w-1/2 p-5">
                <div class="flex justify-between mb-4 mt-1 h-14 items-center">
                    <img src="{{ asset('images/logo-nichommerce3.png') }}" alt="Nichommerce Logo" class="w-24 h-full">
                    <h2 class="text-2xl font-bold">Buat Akun</h2>
                </div>
                <p class="mb-4 text-center mt-8 font-bold text-xl">DAFTAR</p>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col justify-center items-center">
                    @csrf
                    <div class="mb-4 w-full">
                        <label for="name" class="block text-gray-700">Nama</label>
                        @error('name')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                        <input type="text" id="name" name="name"
                            class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                            required>
                    </div>
                    <div class="mb-4 w-full">
                        <label for="email" class="block text-gray-700">Email</label>
                        @error('email')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                        <input type="email" id="email" name="email"
                            class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600"
                            required>
                    </div>
                    <div class="mb-4 w-full">
                        <label for="password" class="block text-gray-700">Password</label>
                        @error('password')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                        <input type="password" id="password" name="password"
                            class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600"
                            required>
                    </div>
                    <div class="mb-4 w-full">
                        <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                            required>
                    </div>
                    <button type="submit"
                        class="w-44 bg-[#cd15bd] text-white py-2 rounded-xl hover:bg-fuchsia-700 transition duration-200">Daftar</button>
                </form>
                <p class="mt-2 text-center">Sudah punya akun? <a href="{{ url('login') }}"
                        class="text-purple-600 text-[cd15bd]">Log In</a></p>
            </div>
            <div class="md:w-1/2 flex justify-center items-center p-5">
                    <img src="{{ asset('images/login2.jpg') }}" alt="NJS ZX-1 V2" class="h-full">
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.querySelector('form');
            const registerButton = document.querySelector('button[type="submit"]');

            registerButton.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah submit form secara default

                Swal.fire({
                    title: 'Konfirmasi Pendaftaran',
                    text: "Apakah Anda yakin ingin mendaftar dengan informasi ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Daftar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        registerForm.submit(); // Jika dikonfirmasi, submit form
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
</body>

</html>