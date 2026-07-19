<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ویرایش پست
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @auth
                    @if(auth()->user()->is_admin)
                        <div class="mb-6 flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div>
                                <span class="text-sm font-medium text-gray-700">وضعیت انتشار:</span>
                                @if($post->is_published)
                                    <span class="text-emerald-600 text-sm font-medium">منتشر شده</span>
                                @else
                                    <span class="text-amber-600 text-sm font-medium">در انتظار تایید</span>
                                @endif
                            </div>

                            @unless($post->is_published)
                                <form action="{{ route('posts.approve', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 bg-emerald-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-emerald-700 transition">
                                        <i class="fa-solid fa-check"></i>
                                        تایید و انتشار
                                    </button>
                                </form>
                            @endunless
                        </div>
                    @endif
                @endauth

                <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- عنوان --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">عنوان</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}"
                               class="w-full border rounded-md px-3 py-2 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- اسلاگ --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">اسلاگ</label>
                        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}"
                               class="w-full border rounded-md px-3 py-2 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('slug') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- دسته‌بندی --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">دسته‌بندی</label>
                        <select name="category_id"
                                class="w-full border rounded-md px-3 py-2 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">بدون دسته‌بندی</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- محتوا --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">محتوا</label>
                        <textarea name="content" rows="6"
                                  class="w-full border rounded-md px-3 py-2 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('content', $post->content) }}</textarea>
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
                               class="w-full border rounded-md px-3 py-2 bg-white text-gray-900">
                        @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- تاریخ انتشار --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">تاریخ انتشار</label>
                        <input type="datetime-local" name="published_at"
                               value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"
                               class="w-full border rounded-md px-3 py-2 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
