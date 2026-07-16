<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            دسته‌بندی: {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition">{{ $post->title }}</a>
                            </h3>

                            <div class="text-sm text-gray-500 mb-3">
                                نویسنده: {{ $post->user->name ?? 'نامشخص' }}
                                | بازدید: {{ $post->views }}
                                | انتشار: {{ $post->published_at?->format('Y-m-d H:i') }}
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
                        هیچ پستی در این دسته‌بندی وجود ندارد.
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
