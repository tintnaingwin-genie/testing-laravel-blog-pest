<div class="
    grid {{ $class }} gap-6

    @if($header)
        sticky top-0
        p-4
        text-sm uppercase tracking-wider font-medium
        bg-gray-200
    @else
        p-4
        bg-white
        border-b-2 border-gray-100
    @endif
">
    {{ $slot }}
</div>
