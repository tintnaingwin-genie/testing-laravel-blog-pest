@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm uppercase tracking-wider font-medium']) }}>
    <span class="h-10 flex items-center">{{ $value ?? $slot }}</span>
</label>
