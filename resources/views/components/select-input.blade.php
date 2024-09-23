@props([
    'options' => [], // Array of options (value => label)
    'selected' => null,
    'placeholder' => null,
    'disabled' => false,
])

<select 
    {{ $disabled ? 'disabled' : '' }} 
    {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full']) }}
>
    @if($placeholder)
        <option value="" disabled selected>{{ $placeholder }}</option>
    @endif

    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ (string) $value === (string) old($attributes->get('name'), $selected) ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
