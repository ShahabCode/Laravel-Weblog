<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            همه پست‌ها
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($searchTerm)
                <div class="mb-6 text-gray-600">
                    نتایج جستجو برای: <span class="font-semibold text-gray-900">«{{ $searchTerm }}»</span>
                    <a href="{{ route('posts.index') }}" class="text-sm text-indigo-600 hover:underline mr-2">(پاک کردن)</a>
                </div>
            @endif

            @if($posts->count())
                <div class="grid gap-6">
                    @foreach($posts as $post)
                        <div class="bg-white shadow rounded-lg p-6">

                            @if($post->image)
                                <img
                                    src="{{ asset('storage/' . $post->image) }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-64 object-cover rounded mb-4"
                                >
                            @endif

                            <h3 class="text-2xl font-bold mb-2 text-gray-900">

                                @if($post->category)
                                    <a href="{{ route('categories.show', $post->category) }}"
                                       class="inline-block text-xs font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full mb-3 hover:bg-indigo-100 transition">
                                        {{ $post->category->name }}
                                    </a>
                                @endif

                                <a href="{{ route('posts.show', $post) }}"
                                class="hover:text-blue-600 transition"
                                >
                                {{ $post->title }}
                                </a>
                            </h3>

                            <div class="text-sm text-gray-500 mb-3">
                                نویسنده:
                                {{ $post->user->name ?? 'نامشخص' }}

                                |
                                بازدید:
                                {{ $post->views }}

                                |
                                انتشار:
                                {{ $post->published_at?->format('Y-m-d H:i') }}
                            </div>

                            <p class="text-gray-700">
                                {{ Str::limit($post->content, 200) }}
                            </p>

                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>

            @else
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-500">
                        هنوز هیچ پستی منتشر نشده است.
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
