@error($name)
<div {{ $attributes->except(['message', 'name'])->merge(['class' => 'p-2 bg-red-500 text-white']) }}>{{ $message }}</div>
@enderror
