@foreach ($jobPosts as $jobPost)
    <a href="{{ route('job-posts.details', $jobPost) }}" class="block">
        <div
            class="bg-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg transition-colors duration-200">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                    {{ $jobPost->title }}</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $jobPost->company->name }}</p>
                <p class="mt-1 text-gray-600 dark:text-gray-400">{{ !empty($jobPost->location) ? $jobPost->location : 'Location not specified' }}</p>
                <p class="mt-1 text-gray-600 dark:text-gray-400">
                    {{ $jobPost->salary ? '$ ' . number_format($jobPost->salary, 2) : 'Salary not specified' }}</p>
                <p class="mt-1 font-bold text-gray-800 dark:text-gray-300">
                    {{ $positionTypes[$jobPost->position_type] }}</p>
            </div>
        </div>
    </a>
@endforeach
