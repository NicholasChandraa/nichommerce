@extends('layouts.mainLayout')

@section('title', 'Edit Profile | N-MERCE')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

    <style>
        .hidden-input {
            display: none;
        }

        .drag-drop-area {
            border: 2px dashed #cbd5e0;
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
            transition: border-color 0.3s;
        }

        .drag-drop-area.dragover {
            border-color: #4c51bf;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            text-align: center;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow: auto;
        }

        .cropper-container {
            max-width: 100%;
            height: auto;
        }

        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }
    </style>

<div class="flex min-h-screen">
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

    <!-- Profile Section -->
    <section class="py-16 mb-[100px]">
        <div class="container mx-auto px-4 lg:flex lg:space-x-16">
            <!-- Profile Information -->
            <div class="lg:w-1/3 flex flex-col items-center text-center mb-8 lg:mb-0">
                <img id="profilePhotoPreview" class="rounded-full w-32 h-32 mb-4"
                    src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('user.profile') }}" class="bg-purple-600 text-white px-4 py-2 rounded">View
                        profile</a>
                </div>
            </div>
            <!-- Profile Form -->
            <div class="lg:w-2/3 bg-white p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold mb-4">Settings Profile</h3>
                <p class="text-gray-500 mb-8">Update your profile picture and personal details.</p>
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <form id="profileForm" method="POST" action="{{ route('user.settings.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name" class="block text-gray-700">Nama</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}"
                                class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}"
                                class="w-full p-3 border rounded-lg">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="phone" class="block text-gray-700">No Handphone</label>
                            <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                                class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label for="address" class="block text-gray-700">Alamat</label>
                            <input type="text" id="address" name="address" value="{{ $user->address }}"
                                class="w-full p-3 border rounded-lg">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="city" class="block text-gray-700">Kota</label>
                            <input type="text" id="city" name="city" value="{{ $user->city }}"
                                class="w-full p-3 border rounded-lg">
                        </div>
                        <div>
                            <label for="postal_code" class="block text-gray-700">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ $user->postal_code }}"
                                class="w-full p-3 border rounded-lg">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Profile Picture</label>
                        <div id="drag-drop-area" class="drag-drop-area" ondragover="handleDragOver(event)"
                            ondragleave="handleDragLeave(event)" ondrop="handleDrop(event)">
                            <div class="text-center">
                                <img id="newProfilePhotoPreview" class="rounded-full w-16 h-16 mx-auto mb-2"
                                    src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                                <input type="file" id="profile_photo" name="profile_photo" class="hidden-input"
                                    onchange="previewProfilePhoto(event)">
                                <label for="profile_photo" class="text-blue-500 cursor-pointer">Click to upload or drag and
                                    drop</label>
                                <p class="text-gray-400 text-sm">SVG, PNG, JPG, JPEG, WEBP or GIF (Best. 400x400px)</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <a href="/user/profile" class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Cancel
                        </a>
                        <button type="button" onclick="showConfirmationModal()"
                            class="bg-purple-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal flex">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4">Konfirmasi Perubahan</h3>
            <p class="mb-8">Apakah kamu yakin ingin menyimpan perubahan?</p>
            <div class="flex justify-center space-x-4">
                <button onclick="hideConfirmationModal()"
                    class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Cancel</button>
                <button onclick="submitForm()" class="bg-purple-600 text-white px-4 py-2 rounded">Confirm</button>
            </div>
        </div>
    </div>

    <!-- NEW: Crop Modal -->
    <div id="cropModal" class="modal flex">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4">Crop Foto</h3>
            <div>
                <img id="cropImage" style="max-width: 100%;" />
            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <button onclick="hideCropModal()" class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Cancel</button>
                <button onclick="cropImage()" class="bg-purple-600 text-white px-4 py-2 rounded">Crop</button>
            </div>
        </div>
    </div>
        
    </div>
</div>


@include('layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<!-- JavaScript to handle the burger menu and modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const burger = document.getElementById('burger');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

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

        // Close modal when clicking outside
        confirmModal.addEventListener('click', function(event) {
            if (event.target === confirmModal) {
                confirmModal.classList.add('hidden');
            }
        });
    });

    let cropper;

        function previewProfilePhoto(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const dataURL = reader.result;
                const image = document.getElementById('cropImage');
                image.src = dataURL;
                showCropModal();
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    movable: true,
                    zoomable: true,
                    rotatable: true,
                    scalable: true,
                    responsive: true,
                    cropBoxResizable: true,
                });
            };
            reader.readAsDataURL(input.files[0]);
        }

        function handleDragOver(event) {
            event.preventDefault();
            const dragDropArea = document.getElementById('drag-drop-area');
            dragDropArea.classList.add('dragover');
        }

        function handleDragLeave(event) {
            const dragDropArea = document.getElementById('drag-drop-area');
            dragDropArea.classList.remove('dragover');
        }

        function handleDrop(event) {
            event.preventDefault();
            const dragDropArea = document.getElementById('drag-drop-area');
            dragDropArea.classList.remove('dragover');
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                const input = document.getElementById('profile_photo');
                input.files = files;
                previewProfilePhoto({
                    target: input
                });
            }
        }

        function showCropModal() {
            document.getElementById('cropModal').style.display = 'flex';
        }

        function hideCropModal() {
            document.getElementById('cropModal').style.display = 'none';
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }

        function cropImage() {
            const canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400,
            });
            canvas.toBlob((blob) => {
                const url = URL.createObjectURL(blob);
                const output = document.getElementById('newProfilePhotoPreview');
                output.src = url;

                const fileInput = document.getElementById('profile_photo');
                const dataTransfer = new DataTransfer();
                const file = new File([blob], 'cropped.jpg', {
                    type: 'image/jpeg'
                });
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                hideCropModal();
            }, 'image/jpeg');
        }

        function showConfirmationModal() {
            document.getElementById('confirmationModal').style.display = 'flex';
        }

        function hideConfirmationModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function submitForm() {
            document.getElementById('profileForm').submit();
        }
</script>

    
@endsection