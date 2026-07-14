<header x-data="{ open: false }" class="bg-white/80 backdrop-blur sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- لوگو --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-xl font-bold text-indigo-600">
                <i class="fa-solid fa-feather-pointed"></i>
                <span>{{ config('app.name', 'وبلاگ من') }}</span>
            </a>

            {{-- منو دسکتاپ --}}
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-indigo-600 transition">خانه</a>
                <a href="{{ route('posts.index') }}" class="hover:text-indigo-600 transition">همه پست ها</a>
                @auth
                    <a href="{{ route('posts.my_posts') }}" class="hover:text-indigo-600 transition">پست های من</a>
                @endauth
            </nav>

            {{-- دکمه‌های سمت راست --}}
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <a href="{{ route('posts.create') }}"
                       class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fa-solid fa-pen"></i>
                        پست جدید
                    </a>
                    <a href="{{ route('profile.edit') }}"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-600 transition">
                            خروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-indigo-600 transition">ورود</a>
                    <a href="{{ route('register') }}"
                       class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        ثبت‌نام
                    </a>
                @endauth
            </div>

            {{-- دکمه منو موبایل --}}
            <button @click="open = !open" class="md:hidden text-gray-600 text-xl">
                <i class="fa-solid fa-bars" x-show="!open"></i>
                <i class="fa-solid fa-xmark" x-show="open" x-cloak></i>
            </button>
        </div>

        {{-- منو موبایل --}}
        <div x-show="open" x-cloak class="md:hidden pb-4 space-y-2">
            <a href="{{ url('/') }}" class="block py-2 text-gray-600">خانه</a>
            <a href="{{ route('posts.index') }}" class="hover:text-indigo-600 transition">همه پست‌ها</a>
            @auth
                <a href="{{ route('posts.my_posts') }}" class="hover:text-indigo-600 transition">پست‌های من</a>
                <a href="{{ route('posts.create') }}" class="block py-2 text-indigo-600 font-medium">نوشتن پست</a>
                <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-600">پروفایل</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block py-2 text-red-600">خروج</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-gray-600">ورود</a>
                <a href="{{ route('register') }}" class="block py-2 text-indigo-600 font-medium">ثبت‌نام</a>
            @endauth
        </div>
    </div>
</header>
