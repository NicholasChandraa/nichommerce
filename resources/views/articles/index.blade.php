@extends('article-layouts.articlePage')

@section('title', 'Artikel | N-MERCE')

@section('content')
    <style>
        .popular-article img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        
    .clamp-2 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2; /* Jumlah baris yang ditampilin */
    }
    .clamp-3 {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
    }
    @media (min-width: 1030px) {
        .clamp-3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 3;
        }
    }
    </style>
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-[500px]" style="background-image: url('images/pemandangan2.jpg')">
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
                <form method="GET" action="{{ route('articles.filter') }}" class="mb-4 flex">
                    <input type="text" name="search" id="search"
                        class="w-full text-gray-800 border border-gray-300 rounded-tl-lg rounded-bl-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
                    <button type="submit"
                        class="bg-purple-500 text-blac px-4 py-2 rounded-tr-lg rounded-br-lg hover:bg-purple-600 transition duration-200">Search</button>
                </form>
            </div>
        </div>
    </section>

    <div class="container mx-auto my-10 p-4">
        <!-- Form filter dan pencarian -->
        <form method="GET" action="{{ route('articles.filter') }}" class="mb-4 bg-white">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="category_id" class="block text-gray-700 font-semibold mb-2">Kategori</label>
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
                    <label for="start_date" class="block text-gray-700 font-semibold mb-2">Rentang Tanggal Awal</label>
                    <input type="date" name="start_date" id="start_date"
                        class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ request('start_date') }}">
                </div>
                <div>
                    <label for="end_date" class="block text-gray-700 font-semibold mb-2">Rentang Tanggal Akhir</label>
                    <input type="date" name="end_date" id="end_date"
                        class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ request('end_date') }}">
                </div>
                <div class="flex gap-2 pb-1 items-end">
                    <button type="submit"
                        class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition duration-200">Filter</button>
                    <a href="{{ route('articlePages.index') }}"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-500 hover:text-white transition duration-200">Clear
                        Filter</a>
                </div>
            </div>
        </form>
        <!-- Akhir form filter dan pencarian -->

        @if ($articles->isEmpty())
            <p class="text-gray-600">No articles available.</p>
        @else
            <!-- Popular Articles -->
            <section class="mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold">Artikel Terbaru</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($articles->take(1) as $article)
                        <!-- Article 1 -->
                        <article class="bg-white overflow-hidden">
                            <a href="{{ route('articlePages.show', $article->id) }}">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image"
                                    class="w-full h-[400px] object-cover" />
                            </a>
                            <div class="mt-5">
                                <p class="text-gray-500 text-sm mb-2">{{ $article->created_at->format('F j, Y') }}</p>
                                <a href="{{ route('articlePages.show', $article->id) }}" class="clamp-2">
                                    <h3 class="text-xl font-bold">{{ $article->title }}</h3>
                                </a>
                                <p class="text-gray-600 mt-2 pr-4 clamp-2">{{ $article->author }} -
                                    {{ Str::limit($article->content, 185) }}.</p>
                                <p class="text-gray-500 text-sm mt-2">Kategori - {{ $article->category->name }}</p>
                            </div>
                        </article>
                    @endforeach
                    <!-- Article 2, 3, 4 -->
                    <div class="flex flex-col space-y-6">
                        @foreach ($articles->skip(1)->take(3) as $article)
                            <article class="bg-white overflow-hidden flex items-start space-x-4 popular-article h-full">
                                <div class="w-[380px] h-[100%] ">
                                    <a href="{{ route('articlePages.show', $article->id) }}">
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image"
                                            class="object-fill" />
                                    </a>
                                </div>
                                <div class="px-1">
                                    <p class="text-gray-500 text-sm">{{ $article->created_at->format('F j, Y') }}</p>
                                    <a href="{{ route('articlePages.show', $article->id) }}">
                                        <h4 class="text-lg font-bold clamp-2">{{ $article->title }}</h4>
                                    </a>
                                    <p class="text-gray-500 text-sm text-justify">{{ $article->author }} -
                                        {{ Str::limit($article->content, 120) }}.</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- All Articles -->
            <section class="container mx-auto my-10" id="articles-container">
                @include('articles.partials.articles')
            </section>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('page-link')) {
                        e.preventDefault();
                        const url = e.target.getAttribute('href');
                        if (url) {
                            fetch(url, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                .then(response => response.text())
                                .then(data => {
                                    document.querySelector('#articles-container').innerHTML = data;
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    }
                });
            });
        </script>
    </div>
@endsection
