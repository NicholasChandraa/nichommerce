<h2 class="text-3xl font-bold mb-6">Semua Artikel</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach ($allArticles as $article)
        <article class="bg-white overflow-hidden">
            <a href="{{ route('articlePages.show', $article->id) }}">
                <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image"
                    class="w-full h-[350px] object-cover" />
            </a>
            <div class="mt-5">
                <p class="text-gray-500 text-sm mb-2">{{ $article->created_at->format('F j, Y') }}</p>
                <a href="{{ route('articlePages.show', $article->id) }}">
                    <h3 class="text-xl font-bold clamp-2">{{ $article->title }}</h3>
                </a>
                <p class="text-gray-600 mt-2 clamp-2">{{ $article->author }} - {{ Str::limit($article->content, 185) }}.</p>
                <p class="text-gray-500 text-sm mt-2">Kategori -
                    {{ $article->category->name }}</p>
            </div>
        </article>
    @endforeach
</div>

<!-- Pagination -->
<div class="container mx-auto my-10 flex justify-between items-center">
    @if ($allArticles->onFirstPage())
        <span class="bg-gray-300 text-gray-600 px-4 py-2 rounded">Previous</span>
    @else
        <a href="{{ $allArticles->previousPageUrl() }}"
            class="bg-gray-300 text-gray-600 hover:bg-gray-500 hover:text-white px-4 py-2 rounded page-link"
            data-page="{{ $allArticles->previousPageUrl() }}">Previous</a>
    @endif

    <div class="flex space-x-2">
        @for ($i = 1; $i <= $allArticles->lastPage(); $i++)
            <a href="{{ $allArticles->url($i) }}"
                class="px-4 py-2 rounded {{ $i == $allArticles->currentPage() ? 'bg-purple-500 text-white' : 'bg-gray-300 hover:bg-gray-500 hover:text-white text-gray-600' }} page-link"
                data-page="{{ $allArticles->url($i) }}">{{ $i }}</a>
        @endfor
    </div>

    @if ($allArticles->hasMorePages())
        <a href="{{ $allArticles->nextPageUrl() }}"
            class="bg-gray-300 text-gray-600 hover:bg-gray-500 hover:text-white px-4 py-2 rounded page-link"
            data-page="{{ $allArticles->nextPageUrl() }}">Next</a>
    @else
        <span class="bg-gray-300 text-gray-600 px-4 py-2 rounded">Next</span>
    @endif
</div>

