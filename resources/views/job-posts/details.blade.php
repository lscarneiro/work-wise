<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Posting Details') }}: {{ $jobPost->title }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                    <p><strong class="dark:text-gray-500">{{ __('Location:') }}</strong> {{ $jobPost->location }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Salary:') }}</strong>
                        {{ $jobPost->salary ? '$ ' . $jobPost->salary : '' }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Description:') }}</strong>
                        {{ $jobPost->description }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
