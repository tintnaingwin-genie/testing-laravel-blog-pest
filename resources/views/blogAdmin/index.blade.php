@php
    /** @var \App\Models\BlogPost[] $posts[] */
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-display font-semibold text-xl text-ink leading-tight">
                {{ __('Blog') }}
            </h2>

            <x-button
                :href="action([\App\Http\Controllers\BlogPostAdminController::class, 'create'])"
            >
                New
            </x-button>
        </div>
    </x-slot>

    @if ($errors->any())
        <div class="text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-table>

        <x-row class="grid-cols-6" header>
            <x-column class="col-span-3">Title</x-column>
            <x-column>Author</x-column>
            <x-column right>Date</x-column>
            <x-column></x-column>
        </x-row>

        @foreach($posts as $post)
            <x-row class="grid-cols-6">
                <x-column class="col-span-3 font-semibold flex items-center">
                    <span title="{{ $post->status->label() }}" class="mr-4 flex-none w-2 h-2 rounded-full {{ $post->status->color() }}">
                    </span>
                    {{ $post->title }}
                </x-column>
                <x-column>{{ $post->author }}</x-column>
                <x-column right>{{ $post->date->format('Y-m-d') }}</x-column>
                <x-column right class="space-x-4 text-sm">
                    
                    @if(! $post->isPublished())
                        <form
                            action="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'publish'], $post->slug) }}"
                            method="post"
                        >
                            @csrf()

                            <button name="publish" class="underline">Publish</button>
                        </form>
                    @endif

                    <a  
                        class="underline"
                        href="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'edit'], $post->slug) }}"
                    >
                        Edit
                    </a>
                </x-column>
            </x-row>
        @endforeach
    </x-table>
</x-app-layout>
