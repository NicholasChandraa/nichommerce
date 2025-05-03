<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed | N-MERCE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo-nichommerce.png') }}" type="image/x-icon">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
        <h1 class="text-lg font-bold mb-2">N-MERCE</h1>
        <h2 class="text-xl font-semibold mb-4 text-red-600">Payment Failed</h2>
        <p>Maaf, terjadi kesalahan dalam memproses pembayaranmu, mohon coba lagi.</p>
        <div class="flex justify-center mb-6 mt-3">
            <img src="{{ asset('images/close.png') }}" alt="Error Icon" class="w-24 h-24">
        </div>
        <a href="{{ route('main') }}" class="py-2 px-6 bg-black text-white rounded-lg hover:bg-gray-800">Kembali ke
            Home</a>
    </div>
</body>

</html>
