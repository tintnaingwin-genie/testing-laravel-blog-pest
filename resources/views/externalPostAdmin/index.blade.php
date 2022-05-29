<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-display font-semibold text-xl text-ink leading-tight">
                {{ __('Externals') }}
            </h2>
        </div>
    </x-slot>

    <div>
        @if($pending->isNotEmpty())
            <x-table>
                <x-row header class="grid-cols-6">
                    <x-column class="colspan-2">Title</x-column>
                    <x-column class="colspan-2">URL</x-column>
                    <x-column>Date</x-column>
                    <x-column></x-column>
                </x-row>

                @foreach($pending as $post)
                    <x-row class="grid-cols-6">
                        <x-column class="colspan-2">{{ $post->title }}</x-column>
                        <x-column class="colspan-2">
                            <a href="{{ $post->url }}" target="_blank" rel="noopener noreferrer"
                               class="underline hover:no-underline">
                                {{ $post->url }}
                            </a>
                        </x-column>
                        <x-column>{{ $post->date->format('Y-m-d') }}</x-column>
                        <x-column right>
                            <x-button
                                :href="action([\App\Http\Controllers\ExternalPostAdminController::class, 'approve'], $post)"
                            >
                                Approve
                            </x-button>
                            <x-button
                                :href="action([\App\Http\Controllers\ExternalPostAdminController::class, 'remove'], $post)"
                                color="red"
                                class="ml-2"
                            >
                                Delete
                            </x-button>
                        </x-column>
                    </x-row>
                @endforeach
            </x-table>
        @endif

        @if($active->isNotEmpty())

            <x-table>
                <x-row class="grid-cols-6" header>
                    <x-column class="colspan-3">Title</x-column>
                    <x-column class="colspan-2">URL</x-column>
                    <x-column right>Date</x-column>
                </x-row>

                @foreach($active as $post)
                    <x-row cols="6">
                        <x-column class="colspan-3">{{ $post->title }}</x-column>
                        <x-column class="colspan-2">
                            <a href="{{ $post->url }}" target="_blank" rel="noopener noreferrer"
                               class="underline hover:no-underline">
                                {{ $post->url }}
                            </a>
                        </x-column>
                        <x-column right>{{ $post->date->format('Y-m-d') }}</x-column>
                    </x-row>
                @endforeach
            </x-table>
        @endif

    </div>

</x-app-layout>
