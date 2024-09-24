<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Postings') }}
        </h2>

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-center sm:justify-end">
                <x-primary-button class="max-sm:text-center"
                    x-on:click.prevent="$dispatch('open-modal', 'create-job-post')">
                    {{ __('Create Job Posting') }}
                </x-primary-button>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Id') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-left max-sm:hidden text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Company') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Title') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-left max-sm:hidden text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Location') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-left max-sm:hidden text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Salary') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:text-gray-400 dark:bg-gray-800">
                            @foreach ($jobPosts as $jobPost)
                                <tr>
                                    <td class="px-1 sm:px-6 py-4 whitespace-nowrap">
                                        <a
                                            href="{{ route('admin.job-posts.show', $jobPost->id) }}">{{ $jobPost->id }}</a>
                                    </td>
                                    <td class="px-1 sm:px-6 py-4 whitespace-nowrap max-sm:hidden">
                                        <a
                                            href="{{ route('admin.companies.show', $jobPost->company->id) }}">{{ $jobPost->company->name }}</a>
                                    </td>
                                    <td
                                        class="px-1 sm:px-6 py-4 whitespace-nowrap max-sm:max-w-32 truncate overflow-hidden">
                                        {{ $jobPost->title }}</td>
                                    <td
                                        class="px-1 sm:px-6 py-4 whitespace-nowrap sm:max-w-48 overflow-hidden truncate max-sm:hidden">
                                        {{ $jobPost->location }}</td>
                                    <td class="px-1 sm:px-6 py-4 whitespace-nowrap max-sm:hidden">
                                        {{ $jobPost->salary ? '$ ' . number_format($jobPost->salary, 2) : '' }}</td>
                                    <td class="px-1 sm:px-6 py-4 text-center whitespace-nowrap">
                                        <a class="hover:text-indigo-900"
                                            href="{{ route('admin.job-posts.show', $jobPost->id) }}">{{ __('View / Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $jobPosts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Job Posting Modal -->
    <x-modal name="create-job-post" focusable :show="$errors->any()">
        <form method="post" action="{{ route('admin.job-posts.index') }}" class="p-6">
            @csrf
            @method('post')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('To create a new job posting, fill the fields below') }}</h2>

            <div class="mt-6">
                <x-input-label for="company_id" value="{{ __('Company') }}" />
                <x-select-input id="company_id" name="company_id" :options="$companies" placeholder="Select a Company"
                    :selected="old('company_id')" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="title" value="{{ __('Title') }}" />
                <x-text-input id="title" name="title" type="text" :value="old('title')"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="location" value="{{ __('Location') }}" />
                <x-text-input id="location" name="location" type="text" :value="old('location')"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="position_type" value="{{ __('Position Type') }}" />
                <x-select-input id="position_type" name="position_type" :options="$positionTypes"
                    placeholder="Select a Position Type" :selected="old('position_type')" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('position_type')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="salary" value="{{ __('Salary') }}" />
                <x-text-input id="salary" name="salary" type="number" :value="old('salary')"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('salary')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="{{ __('Description') }}" />
                <x-text-input id="description" name="description" type="text" :value="old('description')"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-primary-button class="ms-3">{{ __('Create Job Posting') }}</x-primary-button>
            </div>
        </form>
    </x-modal>


</x-app-layout>
