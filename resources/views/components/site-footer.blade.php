<footer class="bg-gray-900 text-gray-300 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid sm:grid-cols-3 gap-8">
        <div>
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
                <li><a href="{{ route('posts.index') }}" class="hover:text-white transition">همه پست ها</a></li>
                @guest
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">ثبت‌نام</a></li>
                @endguest
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
