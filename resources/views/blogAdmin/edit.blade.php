<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-display font-semibold text-xl text-ink leading-tight">
                Edit {{ $post->title }}
            </h2>

            <div>
                <x-button
                    :href="action([\App\Http\Controllers\BlogPostAdminController::class, 'create'])"
                    class="mr-2"
                >
                    New
                </x-button>

                <x-button
                    :href="action([\App\Http\Controllers\BlogPostController::class, 'show'], $post->slug)"
                    target="_blank" rel="noopener noreferrer"
                >
                    Show
                </x-button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form
            action="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'update'], $post->slug) }}"
            method="post"
        >
            @if ($errors->any())
                <div class="text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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

                <div class="
                    dropzone
                    fixed bg-blue-100
                    shadow-lg
                    top-0 left-0 right-0 bottom-0 border-dashed border-4 border-blue-700
                    flex items-center justify-center
                    opacity-90
                    rounded
                    m-4
                    hidden
                ">
                    <x-label class="text-2xl text-blue-800">Drop</x-label>
                </div>
                  

                <div class="col-start-4 justify-self-end space-x-4">
                    @if(!$post->isPublished())
                        <x-button name="publish">Save & Publish</x-button>
                    @endif

                    <x-button>Save</x-button>
                </div>
            </x-fieldset>
        </form>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <x-jet-section-title>
                    <x-slot name="title">Slug</x-slot>
                    <x-slot name="description">
                        Changing a post's slug might have <strong>unforeseen side-effects</strong> when already published.
                        We'll automatically add a redirect from the old to new slug, in order to prevent any issues.</x-slot>
                </x-jet-section-title>

                <div class="mt-5 md:mt-0 md:col-span-2 shadow">
                    <form
                            action="{{ action(\App\Http\Controllers\UpdatePostSlugController::class, $post->slug) }}"
                            method="post"
                        >
                            @csrf()
                        <div class="px-4 py-5 bg-white sm:p-6 sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label>Slug</x-label>
                                    <x-input class="block w-full" type="text" name="slug" id="slug" value="{!! $post->slug !!}"/>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-ink bg-opacity-5 text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                            <x-jet-danger-button>Update Slug</x-button>
                        </div>
                    </form>
                </div>
            </div>

            <x-jet-section-border />

            <x-jet-action-section>
                <x-slot name="title">
                    Delete Post
                </x-slot>

                <x-slot name="description">
                    Permanently delete this post.
                </x-slot>

                <x-slot name="content">
                    <div class="max-w-xl text-sm text-gray-600">
                        Think twice before deleting a post, this cannot be undone. All data will be erased permanently.
                    </div>

                    <form
                        action="{{ action(\App\Http\Controllers\DeletePostController::class, $post->slug) }}"
                        method="post"
                        class="mt-5"
                    >
                        @csrf()
                        <x-jet-danger-button>
                            Delete Post
                        </x-jet-danger-button>
                    </form>
                </x-slot>
            </x-jet-action-section>
        </div>
    </div>

    <script>
        const editor = document.querySelector('#body');
        const body = document.querySelector('body');
        const dropzone = document.querySelector('.dropzone');

        const stopEvent = function (e) {
            e.preventDefault()
            e.stopPropagation()
        }

        const showDropzone = function() {
            dropzone.classList.remove('hidden');
        }

        const hideDropzone = function() {
            dropzone.classList.add('hidden');
        }

        body.addEventListener('dragenter', function (e) {
            stopEvent(e);

            showDropzone();
        });

        body.addEventListener('dragover', function (e) {
            stopEvent(e);
        });

        body.addEventListener('drop', function (e) {
            stopEvent(e);

            insertAtCursor(editor, '[…]');

            uploadFile(e.dataTransfer.files[0]);
        });

        function uploadFile(file) {
            let url = '{{ action(\App\Http\Controllers\UploadController::class) }}';

            let xhr = new XMLHttpRequest();

            xhr.open('POST', url, true);

            xhr.addEventListener('readystatechange', function (e) {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    editor.value = editor.value.replace('[…]', '![](' + xhr.responseText + ')');

                    hideDropzone();
                } else if (xhr.readyState === 4 && xhr.status !== 200) {
                    hideDropzone();
                }
            });

            let formData = new FormData();

            formData.append('file', file);

            xhr.send(formData);
        }

        function insertAtCursor(textArea, value) {
            const startPos = textArea.selectionStart;
            const endPos = textArea.selectionEnd;

            textArea.value = textArea.value.substring(0, startPos)
                + value
                + textArea.value.substring(endPos, textArea.value.length);
        }
    </script>
</x-app-layout>
