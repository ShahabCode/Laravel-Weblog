<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- پست جدید --}}
                    <x-iconed-linked-button href="{{ route('posts.create') }}" icon="fa-plus" variant="primary">
                        پست جدید
                    </x-iconed-linked-button>

                    {{-- پست‌های من --}}
                    <x-iconed-linked-button href="{{ route('posts.my_posts') }}" icon="fa-list" variant="success">
                        پست‌های من
                    </x-iconed-linked-button>

                    <x-iconed-linked-button
                        href="{{ route('posts.index') }}"
                        icon="fa-globe"
                        variant="warning"
                    >
                        همه پست‌ها
                    </x-iconed-linked-button>

                    {{-- پروفایل --}}
                    <x-iconed-linked-button href="{{ route('profile.edit') }}" icon="fa-user" variant="outline">
                        پروفایل
                    </x-iconed-linked-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
