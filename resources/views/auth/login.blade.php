<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>N-MERCE | Login</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-md rounded-lg flex flex-col md:flex-row max-w-4xl p-5 md:p-0">

            <div class="md:w-1/2 p-5">
                <div class="flex justify-between mb-4 mt-1 h-14 items-center">
                    <img src="{{ asset('images/logo-nichommerce3.png') }}" alt="NJS Logo" class="w-24 h-full rounded-lg">
                    <h2 class="text-2xl font-bold">Selamat Datang</h2>
                </div>
                <h1 class="mb-4 mt-8 md:mt-20 font-bold text-center text-xl">LOGIN</h1>

                <!-- Tampilan apabila Email atau Password Salah -->
                @if (session('error_message'))
                    <div id="alert-box"
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error_message') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="closeAlert()">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 5.652a1 1 0 00-1.414-1.414L10 7.172 7.066 4.238a1 1 0 00-1.414 1.414L8.586 8.586 5.652 11.52a1 1 0 001.414 1.414L10 10.414l2.934 2.934a1 1 0 001.414-1.414L11.414 8.586l2.934-2.934z" />
                            </svg>
                        </span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                            required>
                    </div>
                    <button type="submit"
                        class="w-44 bg-[#cd15bd] text-white py-2 rounded-xl hover:bg-fuchsia-700 transition duration-200">Login</button>
                </form>
                <div class="mt-6">
                    <div class="flex space-x-2 mt-2">
                        <p class="bg-blue-600 text-white p-2 rounded-full"></p>
                        <p class="bg-blue-400 text-white p-2 rounded-full"></p>
                        <p class="bg-red-500 text-white p-2 rounded-full"></p>
                    </div>
                </div>
                <p class="mt-4">Belum punya akun? <a href="{{ url('register') }}"
                        class="text-purple-600 text-[cd15bd]">Daftar disini</a></p>
            </div>
            <div class="md:w-1/2 flex justify-center items-center p-5">
                <img src="{{ asset('images/login7.jpg') }}" alt="NJS ZX-1 V2" class="w-full h-full">
            </div>
        </div>

    </div>
    <script>
        function closeAlert() {
            var alertBox = document.getElementById('alert-box');
            alertBox.classList.add('fade-out');
            setTimeout(function() {
                alertBox.style.display = 'none';
            }, 500); // Menunggu animasi fade out selesai
        }
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
</body>

</html>
