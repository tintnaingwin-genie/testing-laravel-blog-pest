@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm uppercase tracking-wider font-medium']) }}>
    {{ $value ?? $slot }}
</label>
