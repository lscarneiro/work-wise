<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Posting Details') }}: {{ $jobPost->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $jobPost->title }}
                </h3>
                <div class="mt-4 dark:text-gray-200 flex flex-col gap-4">
                    <p><strong class="dark:text-gray-500">{{ __('Company Name:') }}</strong>
                        <span>{{ $jobPost->company->name }}</span>
                    </p>
                    <p><strong class="dark:text-gray-500">{{ __('Created On:') }}</strong>
                        {{ $jobPost->created_at->format('F j, Y') }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Position Type:') }}</strong>
                        {{ $positionTypes[$jobPost->position_type] }}
                    </p>
                    <p><strong class="dark:text-gray-500">{{ __('Location:') }}</strong>
                        {{ empty($jobPost->location) ? $jobPost->location : 'Not specified' }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Salary:') }}</strong>
                        {{ $jobPost->salary ? '$ ' . number_format($jobPost->salary, 2) : 'Not specified' }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Description:') }}</strong></p>
                    <div class="whitespace-pre-wrap">{{ $jobPost->description }}</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('About ' . $jobPost->company->name) }}
                </h3>
                <div class="dark:text-gray-200 flex flex-col gap-4">
                    <p><strong class="dark:text-gray-500">{{ __('Headquarters:') }}</strong>
                        {{ empty($jobPost->company->location) ? $jobPost->company->location : 'Not specified' }}</p>
                    <div class="whitespace-pre-wrap">{{ $jobPost->company->description }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
