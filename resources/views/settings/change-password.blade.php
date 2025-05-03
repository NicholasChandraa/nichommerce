@extends('layouts.mainLayout')
@section('title', 'NJS Helmet | Change Password')
@section('content')

<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 relative">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20">

        @include('settings.layouts.sidebar')
    </div>

        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 p-6 relative">
           <!-- Burger Menu Button -->
           <button id="burger" class="md:hidden bg-white p-2 w-full text-start z-50">
            <i class="fas fa-bars"></i>
        </button>

            <div class="bg-white md:shadow-md md:rounded-lg p-5 w-full max-w-3xl mx-auto mt-8">
                <div class="flex flex-col mb-6 border-b pb-6">
                    <h1 class="text-xl font-bold mb-1">Set New Password</h1>
                    <p class="text-gray-500 text-sm">Buat Password baru dengan mudah, masukkan password baru yang ingin dibuat.</p>
                </div>

                <div class="flex">
                    <!-- Change Password Form -->
                    <div class="w-full md:w-1/2">
                        <form method="POST" action="{{ route('account.settings.changePassword') }}" class="mb-6" id="changePasswordForm">
                            @csrf
                            <div class="mb-4">
                                @if (session('success'))
                                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <label for="current_password" class="block text-gray-700">Password Saat ini</label>
                                @error('current_password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <input type="password" id="current_password" name="current_password"
                                       class="w-full p-2 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                       required>
                            </div>
                            <div class="mb-4">
                                <label for="new_password" class="block text-gray-700">Password Baru</label>
                                @error('new_password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <div class="relative mt-2">
                                    <input type="password" id="new_password" name="new_password"
                                           class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"
                                           required>
                                </div>
                                <div class="flex items-center mt-2 space-x-2">
                                    <span class="text-gray-600 text-sm">Min. 8 karakter</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="block text-gray-700">Konfirmasi Password Baru</label>
                                <div class="relative mt-2">
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                           class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"
                                           required>
                                </div>
                            </div>
                            <button type="button" id="changePasswordBtn"
                                    class="w-full bg-purple-600 text-white py-2 rounded-xl hover:bg-purple-700 transition duration-200">
                                Change Password
                            </button>
                        </form>
                    </div>
                    <div class="hidden md:flex md:items-center md:w-1/2 md:ml-5">
                        <img src="{{ asset('images/changepassword.webp')}}" alt="" class="w-[300px] object-fit md:mx-auto rounded-md">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Change Password</h2>
            <p class="text-gray-600 mb-6">Apakah kamu yakin ingin mengubah password?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelBtn" class="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">Cancel</button>
                <button id="confirmBtn" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700">Ya</button>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- JavaScript to handle the burger menu and modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burger = document.getElementById('burger');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const changePasswordBtn = document.getElementById('changePasswordBtn');
            const confirmModal = document.getElementById('confirmModal');
            const cancelBtn = document.getElementById('cancelBtn');
            const confirmBtn = document.getElementById('confirmBtn');
            const form = document.getElementById('changePasswordForm');

            burger.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('block');
                overlay.classList.toggle('hidden');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('block');
                overlay.classList.add('hidden');
            });

            changePasswordBtn.addEventListener('click', function() {
                confirmModal.classList.remove('hidden');
            });

            cancelBtn.addEventListener('click', function() {
                confirmModal.classList.add('hidden');
            });

            confirmBtn.addEventListener('click', function() {
                form.submit();
            });

            // Close modal when clicking outside
            confirmModal.addEventListener('click', function(event) {
                if (event.target === confirmModal) {
                    confirmModal.classList.add('hidden');
                }
            });
        });
    </script>

@endsection
