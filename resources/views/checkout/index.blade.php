@extends('layouts.mainLayout')

@section('title', 'Keranjang | N-MERCE')

@section('content')
    <section class="bg-white">
        <div class="container py-16 mx-auto">
            <!--@if (session('error'))-->
            <!--    <div class="alert alert-danger">-->
            <!--        {{ session('error') }}-->
            <!--    </div>-->
            <!--@endif-->
            <div class="font-bold text-3xl mb-5 text-center">Order Confirmation</div>
            <div class="border-b-2 border-black pb-8 text-center">
                <h1 class="font-semibold text-xl">Hello {{ Auth::user()->name }},</h1>
                <p class="text-gray-500 px-8">Pastikan bahwa alamat dan produk yang dibeli sudah sesuai dengan keinginan
                    anda.</p>
                <p class="text-gray-500 px-8">Anda bisa mengubah informasi sesuai dengan kebutuhan anda.</p>
            </div>

            <div class="">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="grid md:grid-cols-3 grid-cols-1 px-12 md:space-x-4">
                        <div class="flex flex-col mt-8">
                            <label for="name" class="text-gray-700 ml-[9px]">Nama</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                        <div class="flex flex-col mt-8">
                            <label for="email" class="text-gray-700 ml-[9px]">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                        <div class="flex flex-col mt-8">
                            <label for="phone" class="text-gray-700 ml-[9px]">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-3 grid-cols-1 px-12 md:space-x-4 border-b-2 border-black pb-10">
                        <div class="flex flex-col mt-8">
                            <label for="city" class="text-gray-700 ml-[9px]">City</label>
                            <input type="text" id="city" name="city" value="{{ $user->city }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                        <div class="flex flex-col mt-8">
                            <label for="address" class="text-gray-700 ml-[9px]">Address</label>
                            <textarea type="text" id="address" name="address" value="{{ $user->address }}" rows="2"
                                class="border rounded-[20px] py-1 px-2 font-semibold" required>{{ $user->address }}</textarea>
                        </div>
                        <div class="flex flex-col mt-8">
                            <label for="postal_code" class="text-gray-700 ml-[9px]">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ $user->postal_code }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                    </div>
                    <div class="py-10 px-4 md:px-[50px] space-y-6">
                        @if ($cart->cartItems->count() > 0)
                            @foreach ($cart->cartItems as $cartItem)
                                <div class="flex flex-col md:flex-row justify-between border-b-2 pb-10">
                                    <div class="flex flex-col md:flex-row">
                                        <img src="{{ asset('storage/' . $cartItem->product->image) }}"
                                            alt="{{ $cartItem->product->name }}"
                                            class="w-[150px] h-[150px] md:w-[250px] md:h-[250px] mb-4 md:mb-0 md:mr-[50px]">

                                        <div class="mr-0 md:mr-[50px]">
                                            <h3 class="font-semibold text-lg md:text-xl mt-2">
                                                {{ $cartItem->product->name }}</h3>
                                            <h3 class="text-gray-700">Kategori: {{ $cartItem->product->category->name }}
                                            </h3>
                                            <p class="text-gray-700">Jumlah: {{ $cartItem->quantity }} </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex flex-col md:items-end">
                                        <p class="text-start md:text-end">
                                            Rp{{ number_format($cartItem->product->price, 0, ',', '.') }}</p>
                                        <p class="font-semibold text-lg mt-auto text-start md:text-end">Subtotal:
                                            Rp{{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="total-price text-start md:text-end font-semibold text-xl md:text-2xl">
                                Total:
                                Rp{{ number_format($cart->cartItems->sum(function ($cartItem) {return $cartItem->product->price * $cartItem->quantity;}),0,',','.') }}
                            </div>
                        @else
                            <p class="text-center text-gray-700">Your cart is empty.</p>
                        @endif

                        <div class="flex justify-between">
                            <a href="/cart"
                                class="py-2 px-6 bg-gray-400 hover:bg-gray-500 font-semibold rounded-full text-white block mt-4">Cancel</a>
                            <button type="submit"
                                class="py-2 px-6 bg-purple-500 hover:bg-purple-600 font-semibold rounded-full text-white block mt-4">Checkout
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @include('layouts.footer')
@endsection
