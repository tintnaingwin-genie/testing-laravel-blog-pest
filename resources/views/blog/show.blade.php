<x-guest-layout>
    <article class="max-w-4xl mx-auto px-6 pt-24 pb-16">
        <header>
            <h1 class="mb-8 max-w-2xl font-display font-medium text-[2.5rem] lg:text-[5rem] leading-none">{{ $post->title }}</h1>
            <p class="max-w-2xl mx-auto flex items-center text-sm uppercase tracking-wider font-medium">
                <a class="font-semibold hover:underline" href="{{ action([\App\Http\Controllers\BlogPostController::class, 'index']) }}">Back</a>
                <span class="-mt-3 mx-2 font-display text-xl">.</span>
                <span>{{ $post->date->format('Y-m-d') }}</span>
                <span class="-mt-3 mx-2 font-display text-xl">.</span>
                <span>Written by {{ $post->author }}</span>
                <x-last-seen :post="$post"/>
            </p>
        </header>

        <main class="my-24 markup">
            {!! $body !!}
        </main>

        <aside class="max-w-2xl mx-auto flex justify-between">
            <p class="flex items-center text-sm uppercase tracking-wider font-medium">
                <a class="font-semibold hover:underline" href="{{ action([\App\Http\Controllers\BlogPostController::class, 'index']) }}">Back</a>
                <span class="-mt-3 mx-2 font-display text-xl">.</span>
                <span>{{ $post->date->format('Y-m-d') }}</span>
                <span class="-mt-3 mx-2 font-display text-xl">.</span>
                <span>Written by {{ $post->author }}</span>
            </p>

            <livewire:vote-button :post="$post" />
        </aside>

        <x-footer/>
    </article>
</x-guest-layout>
