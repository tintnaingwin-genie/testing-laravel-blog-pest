<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-display font-semibold text-xl text-ink leading-tight">
                New Blog Post
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form
            action="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'store']) }}"
            method="post"
        >
                @csrf()

                <x-fieldset>
                    <x-label for="title">Title</x-label>
                    <x-input type="text" name="title" id="title" value="{!! $post->title !!}"/>

                    <x-label for="author">Author</x-label>
                    <x-input type="text" name="author" id="author" value="{!! $post->author !!}"/>

                    <x-label for="date">Date</x-label>
                    <x-input type="date" name="date" id="date" value="{!! $post->date->format('Y-m-d') !!}"/>
            
                    <x-label class="col-start-1" for="body">Body</x-label>
                    <x-textarea class="col-span-3" name="body" id="body" rows="20">{{ $post->body }}</x-textarea>
            
                    <x-button class="col-start-4 justify-self-end">Create</x-button>
                </x-fieldset>
        </form>
    </div>

</x-app-layout>
