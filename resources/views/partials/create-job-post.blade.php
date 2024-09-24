<div class="mt-6">
    <x-input-label for="title" value="{{ __('Title') }}" />
    <x-text-input id="title" name="title" type="text" :value="old('title')"
        placeholder="{{ __('e.g. Sr. Software Engineer - Front End') }}" class="mt-1 block w-full" />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="location" value="{{ __('Location') }}" />
    <x-text-input id="location" name="location" type="text" :value="old('location')"
        placeholder="{{ __('e.g. Toronto, Ontario, Canada') }}" class="mt-1 block w-full" />
    <x-input-error :messages="$errors->get('location')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="position_type" value="{{ __('Position Type') }}" />
    <x-select-input id="position_type" name="position_type" :options="$positionTypes"
        placeholder="{{ __('Select a Position Type') }}" :selected="old('position_type')" class="mt-1 block w-full" />
    <x-input-error :messages="$errors->get('position_type')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="salary" value="{{ __('Salary') }}" />
    <x-text-input id="salary" name="salary" type="number" :value="old('salary')" placeholder="{{ __('99999.99') }}"
        class="mt-1 block w-full" />
    <x-input-error :messages="$errors->get('salary')" class="mt-2" />
</div>

<div class="mt-6">
    <x-input-label for="description" value="{{ __('Description') }}" />
    <x-textarea-input id="description" name="description" rows="5"
        placeholder="{{ __('Enter job description...') }}" class="mt-1 block w-full">
        {{ old('description') }}
    </x-textarea-input>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>
