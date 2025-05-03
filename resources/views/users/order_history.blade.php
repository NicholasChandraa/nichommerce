<!-- resources/views/user/order_history.blade.php -->
@extends("layouts.mainLayout")

@section("content")
    <div class="bg-gray-100 relative">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <div
                class="inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20"
            >
                @include("settings.layouts.sidebar")
            </div>

            <!-- Overlay -->
            <div
                id="overlay"
                class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden"
            ></div>

            <!-- Main Content -->
            <div class="flex-1 p-6 relative">
                <!-- Burger Menu Button -->
                <button
                    id="burger"
                    class="md:hidden bg-white p-2 w-full text-start z-50"
                >
                    <i class="fas fa-bars"></i>
                </button>

                <div class="bg-white md:shadow-md md:rounded-lg p-5 w-full max-w-3xl mx-auto mt-8">
                    <h2 class="text-2xl font-bold mb-4">Histori Pesanan</h2>
                    <div class="hidden lg:block">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Gambar</th>
                                    <th class="py-2 px-4 border-b">Produk</th>
                                    <th class="py-2 px-4 border-b">Jumlah</th>
                                    <th class="py-2 px-4 border-b">Total Harga</th>
                                    <th class="py-2 px-4 border-b">Status</th>
                                    <th class="py-2 px-4 border-b">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="py-2 px-4 border-b">
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-10 h-10 object-cover">
                                            </td>
                                            <td class="py-2 px-4 border-b">{{ $item->product->name }}</td>
                                            <td class="py-2 px-4 border-b">{{ $item->quantity }}</td>
                                            <td class="py-2 px-4 border-b">{{ 'Rp. ' . number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="py-2 px-4 border-b">{{ $order->status }}</td>
                                            <td class="py-2 px-4 border-b">{{ strftime('%d %B %Y', strtotime($order->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="block lg:hidden">
                        @foreach ($orders as $order)
                            @foreach ($order->orderItems as $item)
                                <div class="bg-white shadow-md rounded-lg mb-4 p-4">
                                    <div class="mb-2">
                                        <span class="font-bold">Gambar:</span>
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-10 h-10 object-cover">
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-bold">Produk:</span> {{ $item->product->name }}
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-bold">Jumlah:</span> {{ $item->quantity }}
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-bold">Total Harga:</span> {{ 'Rp. ' . number_format($item->price, 0, ',', '.') }}
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-bold">Status:</span> {{ $order->status }}
                                    </div>
                                    <div>
                                        <span class="font-bold">Tanggal:</span> {{ strftime('%d %B %Y', strtotime($order->created_at)) }}
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const burger = document.getElementById('burger');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const changePasswordBtn =
                document.getElementById('changePasswordBtn');
            const confirmModal = document.getElementById('confirmModal');
            const cancelBtn = document.getElementById('cancelBtn');
            const confirmBtn = document.getElementById('confirmBtn');
            const form = document.getElementById('changePasswordForm');

            burger.addEventListener('click', function () {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('block');
                overlay.classList.toggle('hidden');
            });

            overlay.addEventListener('click', function () {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('block');
                overlay.classList.add('hidden');
            });

            changePasswordBtn.addEventListener('click', function () {
                confirmModal.classList.remove('hidden');
            });

            cancelBtn.addEventListener('click', function () {
                confirmModal.classList.add('hidden');
            });

            confirmBtn.addEventListener('click', function () {
                form.submit();
            });

            // Close modal when clicking outside
            confirmModal.addEventListener('click', function (event) {
                if (event.target === confirmModal) {
                    confirmModal.classList.add('hidden');
                }
            });
        });
    </script>
    @include("layouts.footer")
@endsection
