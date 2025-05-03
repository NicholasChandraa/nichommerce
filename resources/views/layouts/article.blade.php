<!-- Header -->
<header class="bg-white p-4 shadow mt-16">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="text-center mx-auto">
            <h1 class="text-3xl font-bold">Artikel</h1>
            <p class="text-sm"> Place for News, Knowledge, and Entertainment.</p>
        </div>
    </div>
</header>

<section>
    <div class="bg-white shadow-md overflow-hidden">
        <img src="{{ 'images/background7.webp' }}" alt="John Wick: Chapter 4" class="w-full h-[500px] object-cover">
        <div class="container mx-auto p-4 sm:p-0">
            @foreach ($articles as $article)
                @if ($article->id == 23)
                    <div class="py-5">
                        <h2 class="text-xl font-bold">{{ $article->title }}</h2>
                        <p class="text-gray-600 text-sm">{{ $article->author }} •
                            {{ $article->created_at->diffForHumans() }} • {{ $article->category->name }}</p>
                        <p class="mt-2">{{ Str::limit($article->content, 100) }}</p>
                        <a href="{{ route('articlePages.show', $article->id) }}"
                            class="bg-purple-500 hover:bg-purple-700 text-white px-4 py-2 rounded mt-4 inline-block">Read
                            More</a>
                    </div>
                @endif
            @endforeach
        </div>
</section>

<!-- Articles Section -->
<section class="container mx-auto my-14">
    <div class="container mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl sm:text-2xl font-bold">Berita dan Artikel Terbaru</h2>
                    <a href="/articlePages" class="text-purple-500 hover:text-purple-700">View More</a>
                </div>
                <p class="text-gray-600 mt-2">Selalu up-to-date dengan berita dan artikel terbaru untuk memberikan
                    informasi serta wawasan terbaru seputar otomotif.
                </p>
            </div>
            <div class="md:flex border-t">
                <div class="md:w-2/3 p-6 my-auto">
                    <div class="flex flex-col space-y-4">
                        @foreach ($articles->take(1) as $article)
                            <div class="flex sm:flex-row flex-col">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                        class="w-48 h-48 object-cover rounded-lg mr-4" loading="lazy">
                                @endif
                                <div class="mt-4 sm:mt-0">
                                    <p class="text-gray-600 text-sm">Written by {{ $article->author }}</p>
                                    <a href="{{ route('articlePages.show', $article->id) }}">
                                        <h3 class="text-xl font-bold mt-2">{{ $article->title }}</h3>
                                    </a>
                                    <p class="text-gray-600 mt-2">{{ Str::limit($article->content, 150) }}</p>
                                    <a href="{{ route('articlePages.show', $article->id) }}"
                                        class="bg-purple-500 hover:bg-purple-700 text-white px-4 py-2 rounded mt-4 inline-block">Read
                                        More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="md:w-1/3 p-6 bg-gray-50 border-l">
                    <div class="flex flex-col space-y-4">
                        @foreach ($articles->skip(1)->take(2) as $article)
                            <div class="flex">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                        class="w-16 h-16 object-cover rounded-lg mr-4" loading="lazy">
                                @endif
                                <div>
                                    <p class="text-gray-600 text-sm">Written by {{ $article->author }}</p>
                                    <a href="{{ route('articlePages.show', $article->id) }}">
                                        <h4 class="text-lg font-bold">{{ $article->title }}</h4>
                                    </a>
                                    <a href="{{ route('articlePages.show', $article->id) }}"
                                        class="text-purple-500 hover:text-purple-700">Read
                                        More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</section>



<!-- Main Content -->
<main class="container mx-auto">
    <!-- Lainnya -->
    <!--<section class="mb-8">-->
    <!--    <div class="flex justify-between bg-white p-4  mb-4 shadow">-->
    <!--        <h2 class="text-2xl font-bold">Lainnya</h2>-->
    <!--        <a href="/articlePages" class="text-purple-500 hover:text-purple-700 text-lg">View More</a>-->
    <!--    </div>-->
    <!--    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">-->
    <!--        @foreach ($articles->take(8) as $article)-->
    <!--            <article-->
    <!--                class="flex flex-col bg-white items-center shadow-lg rounded-md overflow-hidden h-[445px] md:h-[380px] lg:h-[470px] p-3">-->
    <!--                @if ($article->image)-->
    <!--                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"-->
    <!--                        class="sm:w-full lg:w-full h-56 md:h-48 rounded-md object-cover lg:object-fill">-->
    <!--                @endif-->
    <!--                <div class="p-4 flex flex-col">-->
    <!--                    <a href="{{ route('articlePages.show', $article->id) }}">-->
    <!--                        <h3 class="font-bold">{{ $article->title }}</h3>-->
    <!--                    </a>-->
    <!--                    <p class="text-gray-600 text-sm mt-2">{{ $article->author }} •-->
    <!--                        {{ $article->created_at->diffForHumans() }} • {{ Str::limit($article->content, 100) }}</p>-->
    <!--                    <a href="{{ route('articlePages.show', $article->id) }}"-->
    <!--                        class="text-purple-500 hover:text-purple-700">Read More-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </article>-->
    <!--        @endforeach-->
    <!--    </div>-->
    <!--</section>-->

    <!-- Bulletin Story -->
    <section class="mb-10 px-3 sm:px-0">
        <h2 class="text-2xl font-bold mb-4">Kategori Artikel</h2>
        <div class="flex space-x-4">
            <div class="text-center font-bold md:text-md text-sm">
                <div
                    class="flex-none w-16 h-16 md:w-24 md:h-24 bg-white shadow-lg rounded-full flex items-center justify-center">
                    <a href="/articles/filter?category_id=3&start_date=&end_date="><img
                            src="{{ asset('images/LogoCollection.png') }}" alt="Logo News" class="p-1 rounded-full">
                    </a>
                </div>
                <p>New <br> Collection</p>
            </div>
            <div class="text-center font-bold md:text-md text-sm">
                <div
                    class="flex-none w-16 h-16 md:w-24 md:h-24 bg-white shadow-lg rounded-full flex items-center justify-center">
                    <a href="/articles/filter?category_id=2&start_date=&end_date=">
                        <img src="{{ asset('images/logoEvents.png') }}" alt="Logo News" class="pt-1 pr-1 rounded-full">
                    </a>
                </div>
                <p>Events</p>
            </div>
            <div class="text-center font-bold md:text-md text-sm">
                <div
                    class="flex-none w-16 h-16 md:w-24 md:h-24 bg-white shadow-lg rounded-full flex items-center justify-center">
                    <a href="/articles/filter?category_id=5&start_date=&end_date=">
                        <img src="{{ asset('images/logoTipsTricks.png') }}" alt="Logo News"
                            class="p-1 pr-2 rounded-full">
                    </a>
                </div>
                <p>Tips <br>& Tricks</p>
            </div>
            <div class="text-center font-bold md:text-md text-sm">
                <div
                    class="flex-none w-16 h-16 md:w-24 md:h-24 bg-white shadow-lg rounded-full flex items-center justify-center">
                    <a href=/articles/filter?category_id=4&start_date=&end_date=">
                        <img src="{{ asset('images/LogoNews.png') }}"
                        alt="Logo News" class="pt-2 rounded-full">
                    </a>
                </div>
                <p>News</p>
            </div>
        </div>
    </section>
</main>
