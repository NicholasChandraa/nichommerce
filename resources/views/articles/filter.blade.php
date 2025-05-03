@extends('article-layouts.articlePage')

@section('title', 'Artikel | N-MERCE')

@section('content')
    <style>
        .popular-article img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-[500px]"
        style="background-image: url('{{ asset('images/pemandangan2.jpg') }}')">
        <div class="container mx-auto h-full flex flex-col justify-center items-start text-white p-4">
            <h1 class="text-5xl font-bold">
                Discover the World of Helmets: Information, Inspiration, and the
                Latest Trends
            </h1>
            <p class="mt-4 text-xl">
                Find the latest articles, product reviews, helmet care tips, and
                much more.
            </p>
            <div class="mt-6 space-x-4">
                <div>
                    <form method="GET" action="{{ route('articles.filter') }}" class="mb-4 flex">
                        <input type="text" name="search" id="search"
                            class="w-full border border-gray-300 rounded-tl-lg rounded-bl-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500"
                            placeholder="Cari judul atau penulis..." value="{{ request('search') }}" />
                        <button type="submit"
                            class="bg-purple-500 text-white px-4 py-2 rounded-tr-lg rounded-br-lg hover:bg-purple-600 transition duration-200">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto my-10 p-4">
        <!-- Form filter dan pencarian -->
        <form method="GET" action="{{ route('articles.filter') }}" class="mb-4 bg-white">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="category_id" class="block text-gray-700 font-semibold mb-2">
                        Kategori
                    </label>
                    <select name="category_id" id="category_id"
                        class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="start_date" class="block text-gray-700 font-semibold mb-2">
                        Rentang Tanggal Awal
                    </label>
                    <input type="date" name="start_date" id="start_date"
                        class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ request('start_date') }}" />
                </div>
                <div>
                    <label for="end_date" class="block text-gray-700 font-semibold mb-2">
                        Rentang Tanggal Akhir
                    </label>
                    <input type="date" name="end_date" id="end_date"
                        class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ request('end_date') }}" />
                </div>
                <div class="flex gap-2 pb-1 items-end">
                    <button type="submit"
                        class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition duration-200">
                        Filter
                    </button>
                    <a href="{{ route('articlePages.index') }}"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-500 hover:text-white transition duration-200">
                        Clear Filter
                    </a>
                </div>
            </div>
        </form>
        <!-- Akhir form filter dan pencarian -->

        @if ($articles->isEmpty())
            <p class="text-gray-600">Tidak ada artikel yang tersedia.</p>
        @else
            <section class="container mx-auto my-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($articles as $article)
                        <article class="bg-white overflow-hidden">
                            <a href="{{ route('articlePages.show', $article->id) }}">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image"
                                    class="w-full h-64 object-cover" />
                            </a>
                            <div class="mt-5">
                                <p class="text-gray-500 text-sm mb-2">
                                    {{ $article->created_at->format('F j, Y') }}
                                </p>
                                <a href="{{ route('articlePages.show', $article->id) }}">
                                    <h3 class="text-xl font-bold">
                                        {{ $article->title }}
                                    </h3>
                                </a>
                                <p class="text-gray-600 mt-2">
                                    {{ $article->author }} -
                                    {{ Str::limit($article->content, 185) }}
                                </p>
                                <p class="text-gray-500 text-sm mt-2">
                                    Kategori - {{ $article->category->name }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="container mx-auto my-10 flex justify-between items-center">
                    @if ($articles->onFirstPage())
                        <span class="bg-gray-300 text-gray-600 px-4 py-2 rounded">
                            Previous
                        </span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}"
                            class="bg-gray-300 text-gray-600 hover:bg-gray-500 hover:text-white px-4 py-2 rounded page-link"
                            data-page="{{ $articles->previousPageUrl() }}">
                            Previous
                        </a>
                    @endif

                    <div class="flex space-x-2">
                        @for ($i = 1; $i <= $articles->lastPage(); $i++)
                            <a href="{{ $articles->url($i) }}"
                                class="px-4 py-2 rounded {{ $i == $articles->currentPage() ? 'bg-purple-500 text-white' : 'bg-gray-300 hover:bg-gray-500 hover:text-white text-gray-600' }} page-link"
                                data-page="{{ $articles->url($i) }}">
                                {{ $i }}
                            </a>
                        @endfor
                    </div>

                    @if ($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}"
                            class="bg-gray-300 text-gray-600 hover:bg-gray-500 hover:text-white px-4 py-2 rounded page-link"
                            data-page="{{ $articles->nextPageUrl() }}">
                            Next
                        </a>
                    @else
                        <span class="bg-gray-300 text-gray-600 px-4 py-2 rounded">
                            Next
                        </span>
                    @endif
                </div>
            </section>
        @endif
    </div>
@endsection
