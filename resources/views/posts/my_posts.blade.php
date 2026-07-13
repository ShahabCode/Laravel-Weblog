<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            پست‌های من
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- پیام‌های success/warning --}}
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('warning'))
                <div class="mb-4 px-4 py-3 bg-yellow-100 text-yellow-700 rounded-md">
                    {{ session('warning') }}
                </div>
            @endif

            {{-- دکمه پست جدید --}}
            <div class="mb-4 flex justify-end">
                <x-iconed-linked-button href="{{ route('posts.create') }}" icon="fa-plus" variant="primary">
                    پست جدید
                </x-iconed-linked-button>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-sm text-right">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">عنوان</th>
                        <th class="px-6 py-3">وضعیت</th>
                        <th class="px-6 py-3">تاریخ انتشار</th>
                        <th class="px-6 py-3">بازدید</th>
                        <th class="px-6 py-3">عملیات</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium">{{ $post->title }}</td>
                            <td class="px-6 py-4">
                                @if($post->is_published)
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">منتشر شده</span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">در انتظار تایید</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $post->published_at ?? '---' }}</td>
                            <td class="px-6 py-4">{{ $post->views }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <x-iconed-linked-button href="{{ route('posts.edit', $post) }}" icon="fa-edit" variant="outline">
                                    ویرایش
                                </x-iconed-linked-button>

                                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                      onsubmit="return confirm('آیا مطمئن هستید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-red-600 text-white text-sm font-semibold hover:bg-red-700">
                                        <i class="fas fa-trash"></i>
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                هیچ پستی یافت نشد
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                {{-- pagination --}}
                @if($posts->hasPages())
                    <div class="px-6 py-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
