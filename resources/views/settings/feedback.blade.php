@extends('layouts.mainLayout')
@section('title', 'NJS Helmet | Send Feedback')
@section('content')

<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

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
                    <h1 class="text-xl font-bold mb-1">Send Feedback</h1>
                    <p class="text-gray-500 text-sm">Feedback dari anda, sangat berarti untuk kami.</p>
                </div>

                <div class="flex">
                    <!-- Feedback Form -->
                    <div class="w-full md:w-1/2">
                        <form method="POST" action="{{ route('account.settings.sendFeedback') }}" id="feedbackForm">
                            @csrf
                            <div class="mb-4">
                                @if (session('success'))
                                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <label for="feedback" class="block text-gray-700">Feedback / Report Bug</label>
                                @error('feedback')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <textarea id="feedback" name="feedback" rows="4"
                                          class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                          required></textarea>
                            </div>
                            <button type="button" id="sendFeedbackBtn"
                                    class="w-full bg-purple-600 text-white py-2 rounded-xl hover:bg-purple-700 transition duration-200">
                                Send Feedback
                            </button>
                        </form>
                    </div>
                    <div class="hidden md:flex md:items-center md:w-1/2 md:ml-5">
                        <img src="{{ asset('images/sendFeedback.webp')}}" alt="" class="w-[300px] object-fit md:mx-auto rounded-md">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Kirim Feedback</h2>
            <p class="text-gray-600 mb-6">Kamu yakin ingin kirim feedback?</p>
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
            const sendFeedbackBtn = document.getElementById('sendFeedbackBtn');
            const confirmModal = document.getElementById('confirmModal');
            const cancelBtn = document.getElementById('cancelBtn');
            const confirmBtn = document.getElementById('confirmBtn');
            const form = document.getElementById('feedbackForm');

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

            sendFeedbackBtn.addEventListener('click', function() {
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