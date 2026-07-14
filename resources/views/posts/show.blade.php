<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <article class="bg-white shadow rounded-lg p-8">

                {{-- تصویر مقاله --}}
                @if($post->image)
                    <img
                        src="{{ asset('storage/' . $post->image) }}"
                        alt="{{ $post->title }}"
                        class="w-full max-h-[500px] object-cover rounded-lg mb-6"
                    >
                @endif

                {{-- عنوان --}}
                <h1 class="text-4xl font-bold mb-4 text-gray-900">
                    {{ $post->title }}
                </h1>

                {{-- اطلاعات مقاله --}}
                <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-8 border-b pb-4">

                    <span>
                        نویسنده:
                        {{ $post->user->name ?? 'نامشخص' }}
                    </span>

                    <span>
                        بازدید:
                        {{ $post->views }}
                    </span>

                    <span>
                        تاریخ انتشار:
                        {{ $post->published_at?->format('Y-m-d H:i') }}
                    </span>

                </div>

                {{-- متن مقاله --}}
                <div class="prose max-w-none text-gray-800">
                    {!! nl2br(e($post->content)) !!}
                </div>

            </article>

            {{-- دکمه بازگشت --}}
            <div class="mt-6">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    بازگشت به لیست پست ها
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
