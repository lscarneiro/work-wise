<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Find your next work below, good luck!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            @foreach ($jobPosts as $jobPost)
                <a href="{{ route('job-posts.details', $jobPost) }}">
                    <div class="bg-white hover:bg-gray-300 dark:hover:bg-gray-600 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-xl font-semibold">{{ $jobPost->title }}</h3>
                            <p class="text-lg text-gray-600 dark:text-gray-400">{{ $jobPost->company->name }}</p>
                            <p class="text-lg text-gray-600 dark:text-gray-400">{{ $jobPost->location }}</p>
                            <p class="text-lg text-gray-600 dark:text-gray-400">{{ $positionTypes[$jobPost->position_type] }}</p>
                           
                        </div>
                    </div>
                </a>
            @endforeach
            <div class="mt-4">
                {{ $jobPosts->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
