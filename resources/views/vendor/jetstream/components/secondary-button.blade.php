<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center border bg-white border-ink hover:border-opacity-80 text-ink px-4 py-2 font-medium focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-ink disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
