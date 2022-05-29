@php
    /** @var \App\Models\BlogPost[] $posts */
    /** @var \App\Models\ExternalPost[] $recents */
@endphp

<x-guest-layout>
    <article class="max-w-4xl mx-auto px-6 pt-24 pb-16">
        <header>
            <h1 class="mb-16 font-display font-medium text-[5rem] lg:text-[8rem] leading-none">My Blog</h1>
        </header>

        <main class="">
            <section class="max-w-2xl mx-auto my-16">
                <h2 class="max-w-2xl mx-auto flex items-center text-sm uppercase tracking-wider font-medium">
                    <span>Articles on PHP</span>
                    <span class="-mt-3 mx-2 font-display text-xl">.</span>
                    <span>Written by staff</span>
                </h2>
                <ul class="mt-8 space-y-2">
                    @foreach($posts as $post)
                        <li>
                            <a
                                href="{{ action([\App\Http\Controllers\BlogPostController::class, 'show'], $post->slug) }}"
                                class="toc-entry"
                            >
                                <h3 class="toc-chapter text-xl font-display font-medium">{{ $post->title }}</h3>
                                <span class="toc-page">{{ $post->date->format('Y-m-d') }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="my-24">
                <div class="max-w-2xl mx-auto">
                    <h2 class="flex items-center text-sm uppercase tracking-wider font-medium">
                        <span>Suggestions</span>
                        <span class="-mt-3 mx-2 font-display text-xl">.</span>
                        <span>By the community</span>
                    </h2>

                    <ul class="mt-8 space-y-2">
                        @foreach($recents as $recent)
                            <li>
                                <a
                                    href="{{ $recent->url }}"
                                    class="toc-entry"
                                >
                                    {{ $recent->date->format('Y-m-d') }}
                                    <h3 class="toc-chapter text-xl font-display font-medium">{{ $recent->title }}</h3>
                                    <span class="toc-page">{{ $recent->domain }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="max-w-4xl mx-auto mt-12 bg-opacity-5 bg-ink px-8 py-12">
                    <div class="max-w-2xl mx-auto">
                        <p class="text-xl font-display">
                            Do you have {{ count($recents) == 0 ? 'a' : 'another' }} suggestion?
                            <br>Leave a link to an interesting blogpost for us to review.
                        </p>

                        <form action="{{ action(\App\Http\Controllers\ExternalPostSuggestionController::class) }}" method="post" class="mt-8 grid grid-cols-[auto,1fr] items-center gap-4">
                            @csrf()

                            <label for="title" class=" text-sm uppercase tracking-wider font-medium">Title</label>
                            <input type="text" name="title" class="border-0 focus:bg-white focus:ring-ink">
                            
                            <x-error class="col-start-2" name="title"/>

                            <label for="url" class=" text-sm uppercase tracking-wider font-medium">URL</label>
                            <input type="text" name="url" class="border-0 focus:bg-white focus:ring-ink">
                            
                            <x-error class="col-start-2" name="url"/>

                            <div class="col-start-2">
                                <x-button>Suggest!</x-button>
                            </div>
                        </form>
                    </div>
                </aside>
            </section>
        </main>

        <x-footer/>
    </article>
</x-guest-layout>
