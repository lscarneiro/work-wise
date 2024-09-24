@props([
    'disabled' => false,
    'rows' => 3,
    'placeholder' => '',
])

<textarea
    {{ $disabled ? 'disabled' : '' }}
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full']) !!}
>{{ old($attributes->get('name'), $slot) }}</textarea>
