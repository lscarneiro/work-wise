<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company Details') }}: {{ $company->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-center sm:justify-end gap-2 sm:gap-4">
                <x-secondary-button x-on:click.prevent="$dispatch('open-modal', 'create-job-post')">
                    {{ __('Create Job Posting') }}
                </x-secondary-button>
                <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'edit-company-{{ $company->id }}')">
                    {{ __('Edit Company') }}
                </x-primary-button>
            </div>

            <!-- Company Information -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Company Information') }}</h3>
                <div class="mt-4 dark:text-gray-200 flex flex-col gap-4">
                    <p><strong class="dark:text-gray-500">{{ __('Name:') }}</strong> {{ $company->name }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Location:') }}</strong> {{ $company->location }}</p>
                    <p><strong class="dark:text-gray-500">{{ __('Description:') }}</strong></p>
                    <div class="whitespace-pre-wrap">{{ $company->description }}</div>
                </div>
            </div>

            <!-- Job Posts Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Job Posts') }}</h3>
                <div class="mt-4">
                    @if ($company->jobPosts->isEmpty())
                        <p class="text-gray-900 dark:text-gray-100">
                            {{ __('No job postings available for this company.') }}</p>
                    @else
                        <table class="w-full divide-y divide-gray-200 dark:divide-gray-500 mt-4">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Job Title') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider max-sm:hidden">
                                        {{ __('Location') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider max-sm:hidden">
                                        {{ __('Salary') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider max-sm:hidden">
                                        {{ __('Published') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider max-sm:hidden">
                                        {{ __('Created On') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="bg-white divide-y divide-gray-200 dark:divide-gray-500 dark:bg-gray-800 dark:text-gray-400">
                                @foreach ($company->jobPosts as $jobPost)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap truncate max-sm:max-w-24">
                                            {{ $jobPost->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap truncate max-w-32 max-sm:hidden">
                                            {{ $jobPost->location }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap max-sm:hidden">
                                            {{ $jobPost->salary ? '$ ' . number_format($jobPost->salary, 2) : '' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap font-bold max-sm:hidden {{ $jobPost->is_published ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $jobPost->is_published ? 'YES' : 'NO' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap max-sm:hidden">
                                            {{ $jobPost->created_at->format('F j, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('admin.job-posts.show', $jobPost) }}"
                                                class="hover:text-indigo-900">
                                                {{ __('View / Edit') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination (if using pagination in controller) -->
                        @if (isset($jobPosts))
                            <div class="mt-4">
                                {{ $jobPosts->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Delete Company Button -->
            <div class="mt-6 flex justify-center sm:justify-end gap-2 sm:gap-4">
                <x-danger-button x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $company->id }}')"
                    class="ms-3">{{ __('Delete Company') }}</x-danger-button>
            </div>
        </div>
    </div>

    <!-- Edit Company Modal -->
    <x-modal name="edit-company-{{ $company->id }}" focusable :show="$errors->any()">
        <form method="post" action="{{ route('admin.companies.update', $company) }}" class="p-6">
            @csrf
            @method('put')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Edit Company') }}</h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('Name') }}" />
                <x-text-input id="name" name="name" type="text" :value="old('name', $company->name)"
                    placeholder="{{ __('e.g. Wise Publishing, Inc.') }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="location" value="{{ __('Location') }}" />
                <x-text-input id="location" name="location" type="text" :value="old('location', $company->location)"
                    placeholder="{{ __('e.g. Toronto, Ontario, Canada') }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="{{ __('Description') }}" />
                <x-textarea-input id="description" name="description" rows="5"
                    placeholder="{{ __('Enter company profile...') }}" class="mt-1 block w-full">
                    {{ old('description', $company->description) }}
                </x-textarea-input>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />

            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-primary-button class="px-3 ms-3">{{ __('Update Company') }}</x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Confirm Delete Modal -->
    <x-modal name="confirm-delete-{{ $company->id }}" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this company?') }}
            </h2>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <form method="post" action="{{ route('admin.companies.destroy', $company) }}" class="ms-3">
                    @csrf
                    @method('delete')
                    <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                </form>
            </div>
        </div>
    </x-modal>


    <!-- Create Job Posting Modal -->
    <x-modal name="create-job-post" focusable :show="$errors->any()">
        <form method="post" action="{{ route('admin.job-posts.index') }}" class="p-6">
            @csrf
            @method('post')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('To create a new job posting, fill the fields below') }}</h2>
            
            <input type="hidden" name="company_id" value="{{ $company->id }}">
            <input type="hidden" name="redirect_to" value="{{ route('admin.companies.show', $company) }}">
            

            @include('partials.create-job-post')

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-primary-button class="ms-3">{{ __('Create Job Posting') }}</x-primary-button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
