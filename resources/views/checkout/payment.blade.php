<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pembayaran | N-MERCE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <!-- Modal Background -->
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-sm p-6 space-y-4">
            <div class="flex flex-col items-center">
                <!-- Icon -->
                <img src="{{ asset('images/cashless-payment.png') }}" alt="Notification Icon" class="mb-4 h-10">
                <!-- Title -->
                <h2 class="text-lg font-semibold text-center">Klik bayar sekarang untuk memproses</h2>
                <!-- Description -->
                <p class="text-gray-600 text-center text-sm">Kalau kamu klik batal barang dikeranjang akan hilang.</p>
                <!-- Notice -->
                <p class="text-red-600 text-center text-sm mt-4">
                    <strong>PEMBERITAHUAN!</strong><br>
                    <p class="text-justify indent-8 text-red-600 text-sm mb-3">
                    Seharusnya setelah klik "Bayar Sekarang" akan muncul popup untuk fitur Payment Gateway menggunakan Midtrans. Namun, karena ini adalah versi produksi maka fitur Payment Gateway ini dinonaktifkan, karena untuk versi produksi dari Midtrans sendiri akan memakan biaya tambahan per transaksi yang berhasil. Sehingga untuk menghindari biaya tambahan tersebut, fitur Payment Gateway ini tidak diaktif, karena website ini tidak sepenuhnya digunakan untuk bertransaksi.
                    </p>
                </p>
            </div>
            <!-- Buttons -->
            <div class="flex flex-col space-y-2 mt-4 w-full">
                <!--<button onclick="pay()"-->
                <!--    class="px-4 py-2 bg-purple-500 text-white rounded-lg text-sm font-medium hover:bg-purple-600 w-full">Bayar-->
                <!--    Sekarang</button>-->
                <a href="{{ route('payment.success') }}"
                    class="px-4 py-2 bg-purple-500 text-white text-center rounded-lg text-sm font-medium hover:bg-purple-600 w-full">Bayar
                    Sekarang</a>
                <a href="{{ route('home') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium text-center hover:bg-gray-300 w-full">Batal</a>
            </div>
        </div>
    </div>
</body>

</html>
