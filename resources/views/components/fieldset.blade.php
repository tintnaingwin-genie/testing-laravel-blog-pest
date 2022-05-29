<fieldset {{ $attributes->merge(['class' => 'grid grid-cols-[4rem,1fr,4rem,1fr] gap-x-6 gap-y-4 bg-white shadow rounded p-8']) }}>
    {{ $slot }}
</fieldset>
