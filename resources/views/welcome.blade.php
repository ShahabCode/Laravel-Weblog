<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'وبلاگ من') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

<x-site-header />

{{-- ===================== هیرو ===================== --}}
<section class="relative bg-gradient-to-l from-indigo-600 to-indigo-800 text-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <h1 class="text-3xl sm:text-5xl font-extrabold leading-tight">
            جایی برای نوشتن، خواندن و به اشتراک‌گذاشتن ایده‌ها
        </h1>
        <p class="mt-4 text-indigo-100 max-w-2xl mx-auto text-base sm:text-lg">
            آخرین پست ها، یادداشت‌ها و تجربه‌ها را اینجا بخوانید یا داستان خودتان را بنویسید.
        </p>
        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('posts.index') }}"
               class="bg-white text-indigo-700 font-medium px-6 py-3 rounded-lg hover:bg-indigo-50 transition">
                مشاهده پست ها
            </a>
            @guest
                <a href="{{ route('register') }}"
                   class="border border-white/60 text-white font-medium px-6 py-3 rounded-lg hover:bg-white/10 transition">
                    شروع نوشتن
                </a>
            @endguest
        </div>
    </div>
</section>

{{-- ===================== محتوای اصلی ===================== --}}
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    @if(!isset($featured))
        {{-- حالت خالی --}}
        <div class="text-center py-20 text-gray-400">
            <i class="fa-regular fa-newspaper text-5xl mb-4"></i>
            <p>هنوز پستی منتشر نشده است.</p>
        </div>
    @else

        {{-- ---------- پست ویژه (فقط در صفحه اول) ---------- --}}
        @if(!request()->filled('page') || request('page') == 1)
            <a href="{{ route('posts.show', $featured) }}" class="group block mb-16">
                <div class="grid md:grid-cols-2 gap-8 items-center bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="h-64 md:h-96 overflow-hidden">
                        <img src="{{ $featured->image ? asset('storage/'.$featured->image) : 'https://placehold.co/800x600?text=' . urlencode($featured->title) }}"
                             alt="{{ $featured->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6 md:p-8">
                        <span class="inline-block text-xs font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                            آخرین پست
                        </span>
                        <h2 class="mt-4 text-2xl md:text-3xl font-bold text-gray-900 group-hover:text-indigo-600 transition">
                            {{ $featured->title }}
                        </h2>
                        <p class="mt-3 text-gray-500 leading-relaxed">
                            {{ $featured->excerpt }}
                        </p>
                        <div class="mt-6 flex items-center gap-4 text-sm text-gray-400">
                            <span class="flex items-center gap-1">
                                <i class="fa-regular fa-user"></i> {{ $featured->user->name }}
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="fa-regular fa-calendar"></i> {{ $featured->published_at->format('Y/m/d') }}
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="fa-regular fa-eye"></i> {{ $featured->views }}
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        {{-- ---------- پست‌های دیگر ---------- --}}
        @if($others->count())
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-gray-900">پست های دیگر</h3>
                <a href="{{ route('posts.index') }}" class="text-sm text-indigo-600 hover:underline">
                    مشاهده همه <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($others as $post)
                    <a href="{{ route('posts.show', $post) }}" class="group bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $post->image ? asset('storage/'.$post->image) : 'https://placehold.co/600x400?text=' . urlencode($post->title) }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h4 class="font-bold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2">
                                {{ $post->title }}
                            </h4>
                            <p class="mt-2 text-sm text-gray-500 line-clamp-2 flex-1">
                                {{ $post->excerpt }}
                            </p>
                            <div class="mt-4 pt-4 border-t flex items-center justify-between text-xs text-gray-400">
                                <span>{{ $post->user->name }}</span>
                                <span class="flex items-center gap-1">
                                    <i class="fa-regular fa-eye"></i> {{ $post->views }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $others->links() }}
            </div>
        @endif
    @endif
</main>

{{-- ===================== فوتر ===================== --}}
<x-site-footer />

</body>
</html>
