<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Find your next work below, good luck!') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="infiniteScroll()" x-init="init()">
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="job-posts-container">
                @include('partials.job-posts-list')
            </div>

            <!-- Infinite Scroll marker -->
            <div x-ref="endOfPageMarker" class="h-1"></div>

            <!-- Loading Indicator -->
            <div class="flex justify-center my-6" x-show="loading">
                <svg class="animate-spin h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v8H4z">
                    </path>
                </svg>
            </div>

            <!-- No More Data Indicator -->
            <div class="text-center text-gray-500 dark:text-gray-400 my-6" x-show="noMoreData">
                {{ __('No more job postings to load.') }}
            </div>

        </div>
    </div>

    <!-- AlpineJS Component for Infinite Scroll -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('infiniteScroll', () => ({
                page: 1,
                loading: false,
                noMoreData: false,
                observer: null,

                init() {
                    this.setupObserver();
                },

                setupObserver() {
                    const options = {
                        root: null,
                        rootMargin: '0px',
                        threshold: 1.0
                    };

                    this.observer = new IntersectionObserver((entries) => {
                        if (entries[0].isIntersecting) {
                            this.loadMore();
                        }
                    }, options);

                    this.observer.observe(this.$refs.endOfPageMarker);
                },

                loadMore() {
                    if (this.loading || this.noMoreData) return;

                    this.loading = true;
                    this.page += 1;

                    const queryParams = new URLSearchParams(window.location.search);
                    queryParams.set('page', this.page);

                    axios.get("{{ route('dashboard') }}" + '?' + queryParams.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (response.data.trim() === '') {
                                this.noMoreData = true;
                                this.observer.disconnect();
                            } else {
                                const container = document.getElementById('job-posts-container');
                                container.insertAdjacentHTML('beforeend', response.data);
                            }
                        })
                        .catch(error => {
                            console.error('Error loading more job postings:', error);
                            this.noMoreData = true;
                            this.observer.disconnect();
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                }
            }))
        });
    </script>
</x-app-layout>
