<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Posting Details') }}: {{ $jobPost->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="mt-6 flex justify-end gap-4">
                @if ($jobPost->is_published)
                    <x-secondary-button
                        x-on:click.prevent="$dispatch('open-modal', 'unpublish-job-post-{{ $jobPost->id }}')">
                        {{ __('Unpublish Job Posting') }}
                    </x-secondary-button>
                @else
                    <x-secondary-button
                        x-on:click.prevent="$dispatch('open-modal', 'publish-job-post-{{ $jobPost->id }}')">
                        {{ __('Publish Job Posting') }}
                    </x-secondary-button>
                @endif

                <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'edit-job-post-{{ $jobPost->id }}')">
                    {{ __('Edit Job Posting') }}
                </x-primary-button>
            </div>

            <!-- Job Posting Information -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Job Posting Information') }}
                </h3>
                <div class="mt-4 dark:text-gray-200 flex flex-col gap-4">
                    <p><strong class="dark:text-gray-500">{{ __('Company Name:') }}</strong>
                        <span>{{ $jobPost->company->name }}</span>
                        <x-secondary-button class="ml-2"
                            x-on:click.prevent="window.location.href='{{ route('admin.companies.show', $jobPost->company->id) }}'">
                            {{ __('View / Edit Company') }}
                        </x-secondary-button>
                    </p>
                    <p><strong class="dark:text-gray-500">{{ __('Created On:') }}</strong>
                        {{ $jobPost->created_at->format('F j, Y') }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Title:') }}</strong> {{ $jobPost->title }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Position Type:') }}</strong>
                        {{ $positionTypes[$jobPost->position_type] }}
                    </p>
                    <p><strong class="dark:text-gray-500">{{ __('Location:') }}</strong> {{ $jobPost->location }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Salary:') }}</strong>
                        {{ $jobPost->salary ? '$ ' . $jobPost->salary : '' }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Published:') }}</strong> <span
                            class="font-bold {{ $jobPost->is_published ? 'text-green-600' : 'text-red-600' }}">{{ $jobPost->is_published ? 'YES' : 'NO' }}</span>
                    </p>
                    <p><strong class="dark:text-gray-500">{{ __('Description:') }}</strong>
                        {{ $jobPost->description }}</p>
                </div>
            </div>


            <!-- Delete Job Posting Button -->
            <div class="mt-6 flex justify-end">
                <x-danger-button x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $jobPost->id }}')"
                    class="ms-3">{{ __('Delete Job Posting') }}</x-danger-button>
            </div>
        </div>
    </div>

    <!-- Edit Job Posting Modal -->
    <x-modal name="edit-job-post-{{ $jobPost->id }}" focusable :show="$errors->any()">
        <form method="post" action="{{ route('admin.job-posts.update', $jobPost) }}" class="p-6">
            @csrf
            @method('put')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Edit Job Posting') }}</h2>

            <div class="mt-6">
                <x-input-label for="title" value="{{ __('Title') }}" />
                <x-text-input id="title" name="title" type="text" :value="old('title', $jobPost->title)"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="location" value="{{ __('Location') }}" />
                <x-text-input id="location" name="location" type="text" :value="old('location', $jobPost->location)"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="position_type" value="{{ __('Position Type') }}" />
                <x-select-input id="position_type" name="position_type" :options="$positionTypes"
                    placeholder="Select a Position Type" :selected="old('position_type', $jobPost->position_type)" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('position_type')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="salary" value="{{ __('Salary') }}" />
                <x-text-input id="salary" name="salary" type="text" :value="old('salary', $jobPost->salary)"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('salary')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="{{ __('Description') }}" />
                <x-text-input id="description" name="description" type="text" :value="old('description', $jobPost->description)"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-primary-button class="px-3 ms-3">{{ __('Update Job Posting') }}</x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Confirm Delete Modal -->
    <x-modal name="confirm-delete-{{ $jobPost->id }}" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this job posting?') }}
            </h2>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <form method="post" action="{{ route('admin.job-posts.destroy', $jobPost) }}" class="ms-3">
                    @csrf
                    @method('delete')
                    <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                </form>
            </div>
        </div>
    </x-modal>

    <!-- Publish Modal -->
    <x-modal name="publish-job-post-{{ $jobPost->id }}" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to publish this job posting?') }}
            </h2>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <form method="post" action="{{ route('admin.job-posts.publish', $jobPost) }}" class="ms-3">
                    @csrf
                    @method('patch')
                    <x-primary-button type="submit">{{ __('Publish') }}</x-primary-button>
                </form>
            </div>
        </div>
    </x-modal>

    <!-- Unpublish Modal -->
    <x-modal name="unpublish-job-post-{{ $jobPost->id }}" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to unpublish this job posting?') }}
            </h2>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <form method="post" action="{{ route('admin.job-posts.unpublish', $jobPost) }}" class="ms-3">
                    @csrf
                    @method('patch')
                    <x-primary-button type="submit">{{ __('Unpublish') }}</x-primary-button>
                </form>
            </div>
        </div>
    </x-modal>
</x-app-layout>
