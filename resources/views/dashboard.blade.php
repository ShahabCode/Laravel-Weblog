<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            داشبورد
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- خوش‌آمدگویی --}}
            <div class="bg-gradient-to-l from-indigo-600 to-indigo-800 text-white rounded-2xl p-8 shadow-sm">
                <h3 class="text-2xl font-bold">
                    خوش آمدی، {{ auth()->user()->name }} 👋
                </h3>
                <p class="mt-2 text-indigo-100">
                    از اینجا می‌تونی پست جدید بنویسی، پست‌هات رو مدیریت کنی یا بین همه‌ی مطالب وبلاگ بگردی.
                </p>
            </div>

            {{-- دسترسی سریع --}}
            <div>
                <h4 class="text-lg font-bold text-gray-900 mb-4">دسترسی سریع</h4>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <a href="{{ route('posts.create') }}"
                       class="group bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 flex flex-col items-center text-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl group-hover:bg-indigo-600 group-hover:text-white transition">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <span class="font-medium text-gray-800">پست جدید</span>
                    </a>

                    <a href="{{ route('posts.my_posts') }}"
                       class="group bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 flex flex-col items-center text-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl group-hover:bg-emerald-600 group-hover:text-white transition">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <span class="font-medium text-gray-800">پست‌های من</span>
                    </a>

                    <a href="{{ route('posts.index') }}"
                       class="group bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 flex flex-col items-center text-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-xl group-hover:bg-amber-600 group-hover:text-white transition">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <span class="font-medium text-gray-800">همه پست‌ها</span>
                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="group bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 flex flex-col items-center text-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xl group-hover:bg-gray-700 group-hover:text-white transition">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <span class="font-medium text-gray-800">پروفایل</span>
                    </a>

                </div>
            </div>

            {{-- دسته‌بندی‌ها --}}
            @php
                $categories = \App\Models\Category::withCount('posts')->get();
            @endphp

            @if($categories->count())
                <div>
                    <h4 class="text-lg font-bold text-gray-900 mb-4">دسته‌بندی‌ها</h4>
                    <div class="flex flex-wrap gap-3">
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category) }}"
                               class="inline-flex items-center gap-2 bg-white border border-gray-200 rounded-full px-4 py-2 text-sm text-gray-700 hover:border-indigo-300 hover:text-indigo-600 transition">
                                {{ $category->name }}
                                <span class="text-xs text-gray-400">({{ $category->posts_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
