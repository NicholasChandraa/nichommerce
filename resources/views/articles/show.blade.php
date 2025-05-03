@extends('article-layouts.article-layouts')

@section('title', "N-MERCE | $article->title")

@section('content')
    <style>
        .indent {
            text-indent: 25px;
        }
    </style>
    <div class="container bg-white mx-auto px-4 py-8">
        <div class="lg:w-[75%] mx-auto">
            <div class="flex justify-between items-center mb-8">
                <a href="/articlePages"
                    class="bg-purple-500 text-white hover:bg-purple-700 hover:text-white px-4 py-2 rounded">
                    Kembali ke Halaman Artikel
                </a>
                <span class="bg-green-200 text-green-700 px-4 py-2 rounded-full text-sm">
                    {{ $article->category->name }}
                </span>
            </div>
            <div class="text-center mb-8">
                <p class="text-gray-500 mt-2">
                    {{ $article->created_at->format('F j, Y') }}
                </p>
                <h1 class="text-2xl lg:text-4xl font-bold mt-4">
                    {{ $article->title }}
                </h1>
            </div>
            <div class="mb-8">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                    class="w-full h-auto rounded-lg" />
            </div>
            <div>
                <p class="text-gray-500 mb-2">
                    Author : {{ $article->author }} - {{ $article->created_at->format('F j, Y') }}
                </p>
            </div>
            <div class="prose max-w-none text-justify">
                @php
                    $content = $article->content;
                    $paragraphs = explode("\n", $content);
                    $isFirst = true;
                @endphp

                @foreach ($paragraphs as $paragraph)
                    @if ($isFirst)
                        <h2 class="text-xl lg:text-3xl font-bold mb-4">
                            {{ $paragraph }}
                        </h2>
                        @php
                            $isFirst = false;
                        @endphp
                    @elseif (preg_match('/^[A-Z].*:/', $paragraph))
                        <h2 class="text-lg lg:text-2xl font-semibold mt-6 mb-2">
                            {{ $paragraph }}
                        </h2>
                    @else
                        <p class="mb-4 indent">{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-4">Artikel Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($articles->take(3) as $related_article)
                    <div class="bg-white overflow-hidden">
                        <a href="{{ route('articlePages.show', $related_article->id) }}">
                            <img src="{{ asset('storage/' . $related_article->image) }}"
                                alt="{{ $related_article->title }}" class="w-full h-[400px] object-cover" />
                        </a>
                        <div class="p-4">
                            <p class="text-gray-500 mb-2">
                                {{ $related_article->created_at->format('F j, Y') }}
                            </p>
                            <a href="{{ route('articlePages.show', $article->id) }}">
                                <h3 class="text-lg font-bold">
                                    {{ $related_article->title }}
                                </h3>
                            </a>
                            <p class="text-gray-700 mt-2">
                                {{ $article->author }} -
                                {{ Str::limit($article->content, 155) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
