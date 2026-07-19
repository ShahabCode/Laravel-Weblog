<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            داشبورد
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(auth()->user()->is_admin)

                {{-- ============ داشبورد ادمین ============ --}}

                {{-- خوش‌آمدگویی --}}
                <div class="bg-gradient-to-l from-gray-800 to-gray-900 text-white rounded-2xl p-8 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-1 text-xs font-medium bg-white/10 px-3 py-1 rounded-full">
                            <i class="fa-solid fa-shield-halved"></i>
                            پنل مدیریت
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold mt-3">
                        خوش آمدی، {{ auth()->user()->name }} 👋
                    </h3>
                    <p class="mt-2 text-gray-300">
                        از اینجا می‌تونی پست‌های در انتظار تایید رو مدیریت کنی و وضعیت کلی سایت رو ببینی.
                    </p>
                </div>

                {{-- آمار کلی --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">

                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['total_posts'] }}</div>
                        <div class="text-sm text-gray-500">کل پست‌ها</div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center mb-3">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['pending_posts'] }}</div>
                        <div class="text-sm text-gray-500">در انتظار تایید</div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['published_posts'] }}</div>
                        <div class="text-sm text-gray-500">منتشرشده</div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <div class="w-10 h-10 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center mb-3">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</div>
                        <div class="text-sm text-gray-500">کاربران</div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <div class="w-10 h-10 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center mb-3">
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stats['total_categories'] }}</div>
                        <div class="text-sm text-gray-500">دسته‌بندی‌ها</div>
                    </div>

                </div>

                {{-- پست‌های در انتظار تایید --}}
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-bold text-gray-900">پست‌های در انتظار تایید</h4>
                        @if($stats['pending_posts'] > 5)
                            <a href="{{ route('posts.index') }}" class="text-sm text-indigo-600 hover:underline">
                                مشاهده همه ({{ $stats['pending_posts'] }})
                            </a>
                        @endif
                    </div>

                    @if($pendingPosts->isEmpty())
                        <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-400">
                            <i class="fa-regular fa-circle-check text-3xl mb-3"></i>
                            <p>هیچ پست در انتظاری وجود ندارد 🎉</p>
                        </div>
                    @else
                        <div class="bg-white rounded-xl shadow-sm divide-y divide-gray-100 overflow-hidden">
                            @foreach($pendingPosts as $post)
                                <div class="flex items-center justify-between gap-4 p-4">
                                    <div class="min-w-0">
                                        <a href="{{ route('posts.show', $post) }}"
                                           class="font-medium text-gray-900 hover:text-indigo-600 transition truncate block">
                                            {{ $post->title }}
                                        </a>
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $post->user->name ?? 'نامشخص' }}
                                            @if($post->category)
                                                · {{ $post->category->name }}
                                            @endif
                                            · {{ $post->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 shrink-0">
                                        <a href="{{ route('posts.edit', $post) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
                                            <i class="fa-solid fa-pen text-sm"></i>
                                        </a>
                                        <form action="{{ route('posts.approve', $post) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1 bg-emerald-600 text-white text-sm px-3 py-2 rounded-lg hover:bg-emerald-700 transition">
                                                <i class="fa-solid fa-check"></i>
                                                تایید
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- دسترسی سریع ادمین --}}
                <div>
                    <h4 class="text-lg font-bold text-gray-900 mb-4">دسترسی سریع</h4>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        <a href="{{ route('posts.index') }}"
                           class="group bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 flex items-center gap-4">
                            <div class="w-11 h-11 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg group-hover:bg-indigo-600 group-hover:text-white transition">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">همه پست‌ها</div>
                                <div class="text-xs text-gray-400">مدیریت و تایید پست‌ها</div>
                            </div>
                        </a>

                        <a href="{{ route('posts.create') }}"
                           class="group bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 flex items-center gap-4">
                            <div class="w-11 h-11 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg group-hover:bg-emerald-600 group-hover:text-white transition">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">پست جدید</div>
                                <div class="text-xs text-gray-400">نوشتن پست جدید</div>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="group bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 flex items-center gap-4">
                            <div class="w-11 h-11 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-lg group-hover:bg-gray-700 group-hover:text-white transition">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">پروفایل</div>
                                <div class="text-xs text-gray-400">مدیریت حساب کاربری</div>
                            </div>
                        </a>

                    </div>
                </div>

            @else

                {{-- ============ داشبورد کاربر عادی ============ --}}

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

            @endif

        </div>
    </div>
</x-app-layout>
