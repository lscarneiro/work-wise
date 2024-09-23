<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Find your next work below, good luck!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            @foreach ($jobPosts as $jobPost)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold">{{ $jobPost->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $jobPost->company->name }} -
                            {{ $jobPost->location }} -
                            {{ $positionTypes[$jobPost->position_type] }} -
                            {{ $jobPost->salary ? '$ ' . $jobPost->salary : '' }}</p>
                        <p class="text-gray-600 dark:text-gray-400">
                        </p>
                        <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Description: </strong></p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $jobPost->truncated_description }}</p>
                    </div>
                </div>
            @endforeach
            <div class="mt-4">
                {{ $jobPosts->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
