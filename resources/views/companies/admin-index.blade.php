<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Companies') }}
        </h2>

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-center sm:justify-end">
                <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'create-company')">
                    {{ __('Create Company') }}
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
                                    class="px-1 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Name') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-left max-sm:hidden text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Location') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-left max-sm:hidden text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Description') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-left max-sm:hidden text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Job Postings') }}
                                </th>
                                <th scope="col"
                                    class="px-1 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-100 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:text-gray-400 dark:bg-gray-800">
                            @foreach ($companies as $company)
                                <tr>
                                    <td class="px-1 sm:px-6 py-4 whitespace-nowrap">
                                        <a
                                            href="{{ route('admin.companies.show', $company->id) }}">{{ $company->id }}</a>
                                    </td>
                                    <td
                                        class="px-1 sm:px-6 py-4 whitespace-nowrap max-sm:max-w-24 truncate overflow-hidden">
                                        {{ $company->name }}</td>
                                    <td class="px-1 sm:px-6 py-4 whitespace-nowrap max-sm:hidden">
                                        {{ $company->location }}</td>
                                    <td class="px-1 sm:px-6 py-4 whitespace-nowrap max-sm:hidden">
                                        {{ $company->truncated_description }}</td>
                                    <td class="px-1 sm:px-6 py-4 whitespace-nowrap max-sm:hidden">
                                        {{ $company->job_posts_count }}</td>
                                    <td class="px-1 sm:px-6 py-4 text-center whitespace-nowrap">
                                        <a
                                            href="{{ route('admin.companies.show', $company->id) }}">{{ __('View / Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Company Modal -->
    <x-modal name="create-company" focusable :show="$errors->any()">
        <form method="post" action="{{ route('admin.companies.index') }}" class="p-6">
            @csrf
            @method('post')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('To create a new company, fill the fields below') }}</h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('Name') }}" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    placeholder="{{ __('Name') }}" :value="old('name')" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="location" value="{{ __('Location') }}" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                    placeholder="{{ __('Location') }}" :value="old('location')" />
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="{{ __('Description') }}" />
                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                    placeholder="{{ __('Description') }}" :value="old('description')" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-primary-button class="ms-3">{{ __('Create Company') }}</x-primary-button>
            </div>
        </form>
    </x-modal>


</x-app-layout>
