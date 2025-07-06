@props([
    'name',
    'label' => '',
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
])

<div class="space-y-1">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500'
        ]) }}
    >

    @error($name)
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
