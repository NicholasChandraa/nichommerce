@extends('layouts.mainLayout')

@section('title', 'Profile | N-MERCE')

@section('content')
    <style>
        .profile-header {
            background: url("{{ asset('images/background.jpg') }}") no-repeat center center;
            background-size: cover;
            height: 200px;
        }

        .profile-avatar {
            margin-top: -90px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            position: relative;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 700px;
            max-height: 90%;
            overflow: auto;
        }

        .modal-content img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: #fff;
            font-size: 35px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
            }
        }
    </style>

    <div class="flex min-h-screen bg-white">
        <!-- Sidebar -->
        <div class="inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20">
            @include('settings.layouts.sidebar')
        </div>

        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 relative">
            <!-- Burger Menu Button -->
            <button id="burger" class="md:hidden bg-white p-2 w-full text-start z-50">
                <i class="fas fa-bars"></i>
            </button>

            <section class="pb-[50px] bg-white">
                <div class="profile-header"></div>
                <div class="container mx-auto px-4 lg:px-0 py-8">
                    <div class="lg:flex-col">
                        <!-- Profile Information -->
                        <div class="text-center mb-8 lg:mb-0">
                            <div class="profile-avatar">
                                <img id="profilePhoto" class="rounded-full w-32 h-32 mx-auto cursor-pointer"
                                    src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                            </div>
                            <h2 class="text-3xl font-bold mt-4">{{ $user->name }}</h2>
                            <p class="text-gray-500">{{ $user->email }}</p>
                        </div>
                        <!-- Additional Information -->
                        <div class="lg:w-2/3 bg-white p-8 rounded-lg  mx-auto mt-3">
                            <h3 class="text-2xl font-bold mb-4">Personal Info</h3>
                            <p class="text-gray-500 mb-8">You can change your personal information by clicking the edit profile
                                button.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-lg font-bold mb-2">Nama Lengkap</h4>
                                    <p class="text-gray-700 border rounded-lg p-3">{{ $user->name }}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold mb-2">Email</h4>
                                    <p class="text-gray-700 border rounded-lg p-3">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold mb-2">No. Handphone</h4>
                                    <p class="text-gray-700 border rounded-lg p-3">{{ $user->phone }}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold mb-2">Tipe Akun</h4>
                                    <p class="text-gray-700 border rounded-lg p-3">{{ Auth::user()->role }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <h4 class="text-lg font-bold mb-2">Address</h4>
                                    <p class="text-gray-700 border rounded-lg p-3">{{ $user->address }}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold mb-2">City</h4>
                                    <p class="text-gray-700 border rounded-lg p-3">{{ $user->city }}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold mb-2">Postal Code</h4>
                                    <p class="text-gray-700 border rounded-lg p-3">{{ $user->postal_code }}</p>
                                </div>
                            </div>
                            <div class="flex justify-end mt-8">
                                <a href="{{ route('user.settings') }}" class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Edit
                                    Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- The Modal -->
            <div id="photoModal" class="modal flex">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                </div>
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
            const profilePhoto = document.getElementById('profilePhoto');
            const modal = document.getElementById('photoModal');
            const closeModal = document.querySelector(".close");

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

            profilePhoto.addEventListener('click', function() {
                modal.style.display = "flex";
            });

            closeModal.addEventListener('click', function() {
                modal.style.display = "none";
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>

@endsection
