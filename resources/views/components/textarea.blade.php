@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-ink border-opacity-20 bg-paper focus:bg-white focus:ring-ink']) !!}>
    {{ $slot }}
</textarea>
