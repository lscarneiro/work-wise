<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Find your next work below, good luck!') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('dashboard') }}"
                class="mb-6 p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="flex flex-col md:flex-row justify-around gap-6">

                    <!-- Search -->
                    <div class="flex-1">
                        <label for="query"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search</label>
                        <input type="text" name="query" id="query" value="{{ request('query') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Jobs, Locations, Companies, etc...">
                    </div>

                    <!-- Salary Range -->
                    <div class="flex flex-col">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salary Range</label>
                        <div class="mt-1 flex space-x-2">
                            <input type="number" name="salary_min" value="{{ request('salary_min') }}"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Min">
                            <input type="number" name="salary_max" value="{{ request('salary_max') }}"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Max">
                        </div>
                    </div>

                    <!-- Position Type -->
                    <div>
                        <label for="position_type"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Position Type</label>
                        <select name="position_type" id="position_type"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">All Types</option>
                            @foreach ($positionTypes as $key => $value)
                                <option value="{{ $key }}"
                                    {{ request('position_type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="flex justify-end items-end">
                        <x-primary-button type="submit" class="px-4 py-2">
                            {{ __('Search') }}
                        </x-primary-button>
                        <x-secondary-button class="ml-2"
                            x-on:click.prevent="window.location.href='{{ route('dashboard') }}'">
                            {{ __('Reset') }}
                        </x-secondary-button>
                    </div>
                </div>
            </form>

            <!-- Job Posts List -->
            <div class="grid grid-cols-1 md:grid-cols-2  gap-6">
                @forelse ($jobPosts as $jobPost)
                    <a href="{{ route('job-posts.details', $jobPost) }}" class="block">
                        <div
                            class="bg-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg transition-colors duration-200">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                    {{ $jobPost->title }}</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $jobPost->company->name }}</p>
                                <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $jobPost->location }}</p>
                                <p class="mt-1 text-gray-600 dark:text-gray-400">
                                    {{ $jobPost->salary ? '$ ' . $jobPost->salary : '' }}</p>
                                <p class="mt-1 text-gray-600 dark:text-gray-400">
                                    {{ $positionTypes[$jobPost->position_type] }}</p>

                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400">No job posts found.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $jobPosts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
