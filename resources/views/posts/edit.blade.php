<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ویرایش پست
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- عنوان --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">عنوان</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}"
                               class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- اسلاگ --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">اسلاگ</label>
                        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}"
                               class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('slug') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- محتوا --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">محتوا</label>
                        <textarea name="content" rows="6"
                                  class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('content', $post->content) }}</textarea>
                        @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- تصویر فعلی --}}
                    @if ($post->image)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">تصویر فعلی</label>
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                                 class="w-40 h-auto rounded-md border">
                        </div>
                    @endif

                    {{-- تصویر جدید --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ $post->image ? 'تغییر تصویر' : 'تصویر' }}
                        </label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full border rounded-md px-3 py-2">
                        @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- تاریخ انتشار --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">تاریخ انتشار</label>
                        <input type="datetime-local" name="published_at"
                               value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"
                               class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('published_at') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- دکمه‌ها --}}
                    <div class="flex gap-3">
                        <x-iconed-linked-button href="{{ route('dashboard') }}" icon="fa-arrow-right" variant="outline">
                            بازگشت
                        </x-iconed-linked-button>

                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700">
                            <i class="fas fa-save"></i>
                            بروزرسانی
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
