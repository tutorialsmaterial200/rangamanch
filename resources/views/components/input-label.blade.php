@props([
    'value' => '',
    'required' => false,
    'for' => ''
])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }} for="{{ $for }}">
    {{ $value ?? $slot }}
    @if($required)
        <span class="text-red-600">*</span>
    @endif
</label>
