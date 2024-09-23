
@props(['message', 'type'])

@php
    $typeClasses = [
        'success' => 'bg-green-500 text-white',
        'warn' => 'bg-yellow-500 text-white',
        'danger' => 'bg-red-500 text-white',
    ];

    // Fallback to 'success' if type is not recognized
    $classes = $typeClasses[$type] ?? $typeClasses['success'];

    // Define icons for different types
    $typeIcons = [
        'success' => 'check-circle',
        'warn' => 'exclamation-circle',
        'danger' => 'x-circle',
    ];

    $icon = $typeIcons[$type] ?? $typeIcons['success'];
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 flex items-center p-4 mb-4 w-full max-w-md text-sm rounded-lg shadow-lg transition-opacity duration-500"
    :class="`{{ $classes }}`"
    role="alert"
    x-transition:enter="transform transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
>
    <!-- Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        @switch($icon)
            @case('check-circle')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                @break
            @case('exclamation-circle')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                @break
            @case('x-circle')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                @break
            @default
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        @endswitch
    </svg>

    <!-- Message -->
    <span class="flex-1">{{ $message }}</span>

    <!-- Close Button -->
    <button @click="show = false" class="ml-4 text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
