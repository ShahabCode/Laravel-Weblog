<footer class="bg-gray-900 text-gray-300 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid sm:grid-cols-4 gap-8">
        <div class="sm:col-span-2 lg:col-span-1">
            <div class="flex items-center gap-2 text-lg font-bold text-white">
                <i class="fa-solid fa-feather-pointed"></i>
                {{ config('app.name', 'وبلاگ من') }}
            </div>
            <p class="mt-3 text-sm text-gray-400 leading-relaxed">
                وبلاگی برای نوشتن و به اشتراک‌گذاشتن ایده‌ها، تجربه‌ها و یادداشت‌های روزمره.
            </p>
        </div>

        <div>
            <h5 class="text-white font-semibold mb-3">لینک‌های سریع</h5>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-white transition">خانه</a></li>
                <li><a href="{{ route('posts.index') }}" class="hover:text-white transition">همه پست‌ها</a></li>
                @auth
                    <li><a href="{{ route('posts.my_posts') }}" class="hover:text-white transition">پست‌های من</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">داشبورد</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">ورود</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">ثبت‌نام</a></li>
                @endauth
            </ul>
        </div>

        <div>
            <h5 class="text-white font-semibold mb-3">دسته‌بندی‌ها</h5>
            <ul class="space-y-2 text-sm">
                @foreach(\App\Models\Category::all() as $category)
                    <li>
                        <a href="{{ route('categories.show', $category) }}" class="hover:text-white transition">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h5 class="text-white font-semibold mb-3">ما را دنبال کنید</h5>
            <div class="flex gap-3">
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 hover:bg-indigo-600 transition">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 hover:bg-indigo-600 transition">
                    <i class="fa-brands fa-telegram"></i>
                </a>
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 hover:bg-indigo-600 transition">
                    <i class="fa-brands fa-twitter"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-800 py-4 text-center text-xs text-gray-500">
        © {{ date('Y') }} {{ config('app.name', 'وبلاگ من') }} — تمامی حقوق محفوظ است.
    </div>
</footer>
