{{-- filepath: d:\PPL-AgroMart\resources\views\dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-green-50 dark:bg-green-900">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-lg dark:bg-green-800 sm:rounded-lg">
                <div class="p-6 text-green-900 dark:text-green-100">
                    <h1 class="mb-4 text-2xl font-bold">Welcome to AgroMart Dashboard</h1>
                    <p class="mb-4">Manage your hydroponic farming efficiently with AgroMart.</p>
                    <div class="mt-6">
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                            Edit Profile
                        </a>
                        <a href="{{ route('home') }}" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            Go to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
