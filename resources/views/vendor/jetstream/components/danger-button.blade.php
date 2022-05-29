<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center bg-red-700 hover:bg-opacity-80 text-paper px-4 py-2 font-medium focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-ink disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
